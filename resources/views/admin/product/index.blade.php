@extends('layout.admin')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h3 class="m-0">Danh sach San pham</h3>
        <a href="{{ url('/product/create') }}" class="btn btn-primary">Them moi</a>
    </div>

    <form method="GET" action="{{ url('/product') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Tim theo ten hoac SKU"
                    value="{{ $keyword }}"
                >
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-control">
                    <option value="">-- Tat ca danh muc --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-info">Loc</button>
                <a href="{{ url('/product') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Danh muc</th>
                <th>Ten</th>
                <th>SKU</th>
                <th>Gia</th>
                <th>Gia KM</th>
                <th>Ton kho</th>
                <th>Trang thai</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $prod)
                <tr>
                    <td>{{ $prod->id }}</td>
                    <td>{{ optional($prod->category)->name }}</td>
                    <td>{{ $prod->name }}</td>
                    <td>{{ $prod->sku }}</td>
                    <td>{{ $prod->price }}</td>
                    <td>{{ $prod->sale_price }}</td>
                    <td>{{ $prod->stock }}</td>
                    <td>{{ $prod->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ url('/product/edit/' . $prod->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ url('/product/delete/' . $prod->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ban chac chan muon xoa?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Khong co du lieu san pham</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
