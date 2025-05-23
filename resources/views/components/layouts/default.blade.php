<!doctype html>
<html>
    <head>
        <title>{{ $title }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
    </head>

    <body>
        <h1>
            @if(auth()->check() && auth()->user()->role->value === 'admin')
                @include('components.admin-navbar')
            @else

                @include('components.navbar')
            @endif

            {{ $slot }}
        </h1>
    </body>
</html>
