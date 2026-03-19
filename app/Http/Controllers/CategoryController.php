<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')
            ->where('is_delete', false)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        $parentCategories = $this->getAvailableParentCategories();

        return view('admin.category.create', ['parentCategories' => $parentCategories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'is_active' => 'nullable|boolean',
        ]);

        if (!empty($validated['parent_id'])) {
            $parent = Category::where('is_delete', false)->find($validated['parent_id']);
            if (!$parent) {
                return back()->withErrors(['parent_id' => 'Danh muc cha khong hop le.'])->withInput();
            }
        }

        Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'parent_id' => $validated['parent_id'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'is_delete' => false,
        ]);

        return redirect('/category')->with('success', 'Them danh muc thanh cong.');
    }

    public function edit(string $id)
    {
        $category = Category::where('is_delete', false)->findOrFail($id);
        $parentCategories = $this->getAvailableParentCategories((int) $category->id);

        return view('admin.category.edit', [
            'category' => $category,
            'parentCategories' => $parentCategories,
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $category = Category::where('is_delete', false)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'is_active' => 'nullable|boolean',
        ]);

        $parentId = isset($validated['parent_id']) ? (int) $validated['parent_id'] : null;

        if ($parentId !== null) {
            if ($parentId === (int) $category->id) {
                return back()->withErrors(['parent_id' => 'Khong the chon chinh no lam danh muc cha.'])->withInput();
            }

            $invalidParentIds = $this->collectDescendantIds((int) $category->id);
            if (in_array($parentId, $invalidParentIds, true)) {
                return back()->withErrors(['parent_id' => 'Khong the chon danh muc con/chau lam danh muc cha.'])->withInput();
            }

            $parent = Category::where('is_delete', false)->find($parentId);
            if (!$parent) {
                return back()->withErrors(['parent_id' => 'Danh muc cha khong hop le.'])->withInput();
            }
        }

        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'parent_id' => $parentId,
            'is_active' => $request->boolean('is_active', false),
        ]);

        return redirect('/category')->with('success', 'Cap nhat danh muc thanh cong.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::where('is_delete', false)->findOrFail($id);
        $category->is_delete = true;
        $category->save();

        return redirect('/category')->with('success', 'Da xoa mem danh muc.');
    }

    private function getAvailableParentCategories(?int $excludeCategoryId = null)
    {
        $query = Category::where('is_delete', false);

        if ($excludeCategoryId !== null) {
            $blockedIds = array_merge([$excludeCategoryId], $this->collectDescendantIds($excludeCategoryId));
            $query->whereNotIn('id', $blockedIds);
        }

        return $query->orderBy('name')->get();
    }

    private function collectDescendantIds(int $categoryId): array
    {
        $children = Category::where('parent_id', $categoryId)->pluck('id')->all();
        $descendantIds = $children;

        foreach ($children as $childId) {
            $descendantIds = array_merge($descendantIds, $this->collectDescendantIds((int) $childId));
        }

        return array_values(array_unique($descendantIds));
    }
}
