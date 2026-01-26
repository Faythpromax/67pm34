<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Register</h1>
        <form action="/product/checkRegister" method="POST">
            @csrf
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>