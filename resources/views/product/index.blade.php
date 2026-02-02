<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
</head>
<body>
    <!-- Show list of products -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        @foreach ($products as $prod)
        <tr>
            <td>{{ $prod['id'] }}</td>
            <td>{{ $prod['name'] }}</td>
            <td>{{ $prod['price'] }}</td>
            <td>{{ $prod['stock'] }}</td>
            <td>
                <a href="/product/edit/{{ $prod['id'] }}">Edit</a>
            <td>
                <form action="/product/delete/{{ $prod['id'] }}" method="POST">
                    @csrf
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach

</body>
</html>