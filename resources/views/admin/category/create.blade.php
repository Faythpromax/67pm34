@extends('layout.admin')

@section('content')
    <h3>Them moi Danh muc</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/category/store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Ten danh muc</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mo ta</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="Duong dan hinh anh">
        </div>

        <div class="form-group">
            <label for="parent_id">Danh muc cha</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">-- Khong co --</option>
                @foreach ($parentCategories as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Kich hoat</label>
        </div>

        <button type="submit" class="btn btn-primary">Luu</button>
        <a href="{{ url('/category') }}" class="btn btn-secondary">Huy</a>
    </form>
@endsection
