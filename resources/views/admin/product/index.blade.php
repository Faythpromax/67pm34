@extends('layout.admin')

@section('content')
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $prod)
        <tr>
            <td>{{ $prod['id'] }}</td>
            <td>{{ $prod['name'] }}</td>
            <td>{{ $prod['price'] }}</td>
            <td>{{ $prod['stock'] }}</td>
            <td>
                <a href="{{ url('/product/edit/'.$prod['id']) }}">Edit</a>
            </td>
            <td>
                <form action="{{ url('/product/delete/'.$prod['id']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
