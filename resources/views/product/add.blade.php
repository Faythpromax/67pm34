<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Add New Product</h1>
        <form action="/product/store" method="POST">
            @csrf
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required><br><br>
            <input type="submit" value="Add Product">
        </form>
    </body>
</html>