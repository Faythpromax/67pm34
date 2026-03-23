@extends('layout.admin')
@section('content')
    <h3>Cap nhat San pham</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/product/update/' . $product->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="category_id">Danh muc</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">-- Khong chon --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Ten san pham</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
        </div>

        <div class="form-group">
            <label for="price">Gia</label>
            <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="form-group">
            <label for="sale_price">Gia khuyen mai</label>
            <input type="number" step="0.01" min="0" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
        </div>

        <div class="form-group">
            <label for="stock">Ton kho</label>
            <input type="number" min="0" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mo ta</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ old('image', $product->image) }}" placeholder="Duong dan anh">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Kich hoat</label>
        </div>

        <button type="submit" class="btn btn-primary">Cap nhat</button>
        <a href="{{ url('/product') }}" class="btn btn-secondary">Huy</a>
    </form>
@endsection