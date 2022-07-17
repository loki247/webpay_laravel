<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TBK - @yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
</head>
<body>
<div class="container">
    <h1>@yield('title')</h1>
    <div>
        @yield('breadcrumbs')
    </div>
    <br>
    <div>
        @yield('content')
    </div>
</div>
</body>
</html>
