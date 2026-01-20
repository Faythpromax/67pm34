<!DOCTYPE html>
<html>
    <head></head>
    <body>
        Ban co {{ $n }} * {{ $n }}:<br>
        @for ($i = 0; $i < $n; $i++)
            @for ($j = 0; $j < $n; $j++)
                @if (($i + $j) % 2 == 0)
                    X
                @else
                    O
                @endif
            @endfor
            <br>
        @endfor
    </body>
</html>