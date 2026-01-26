<!DOCTYPE html>
<html>
    <head></head>
    <body>
        @if (session('loginState'))
            <h1>{{ session('loginState') }}</h1>
        @endif
        <p>Welcome!</p>
    </body>
</html>