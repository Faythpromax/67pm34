@extends('layout.admin')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h3 class="m-0">Danh sach Danh muc</h3>
        <a href="{{ url('/category/create') }}" class="btn btn-primary">Them moi</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ten</th>
                <th>Mo ta</th>
                <th>Hinh anh</th>
                <th>Danh muc cha</th>
                <th>Trang thai</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->image }}</td>
                    <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                    <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ url('/category/edit/' . $category->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ url('/category/delete/' . $category->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ban chac chan muon xoa?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Khong co du lieu danh muc</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
