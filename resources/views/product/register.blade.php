<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <h1>Register</h1>
        <form action="{{ route('checkRegister') }}" method="POST">
            @csrf
            <label>Username:</label>
            <input type="text" name="name" required><br><br>

            <label>Full Name:</label>
            <input type="text" name="fullname" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Register">
        </form>
    </body>
</html>