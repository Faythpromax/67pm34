<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Login</h1>
        <form action="/product/checklogin" method="POST">
            @csrf
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        @if (session('loginState'))
            <h2 style="color:red;">{{ session('loginState') }}</h2>
        @endif
    </body>
</html>