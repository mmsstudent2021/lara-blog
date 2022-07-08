<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lara Blog</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body>

<section class="py-5">
    @yield('content')
</section>


<script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
