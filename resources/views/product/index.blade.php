<!-- <!DOCTYPE html>
<html>
<head>
    <title>Product</title>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>Sample Product</td>
            <td>$10.00</td>
        </tr>
        <td>
            <a href="{{ route('add') }}">Add New Product</a>
        </td>
    </table>
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <!-- Show list of products -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        @foreach ($product as $prod)
        <tr>
            <td>{{ $prod['id'] }}</td>
            <td>{{ $prod['name'] }}</td>
            <td>{{ $prod['price'] }}</td>
        </tr>
        @endforeach
        <!-- <td>
            <a href="{{ route('add') }}">Add New Product</a>
        </td> -->
</body>
</html>