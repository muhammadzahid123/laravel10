<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', 'Laravel Ecommerce Project')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    @include('partials.styles')

</head>

<body>
    <div class="wrapper">
        @include('partials.navbar')
        @include('partials.messages')
        @yield('content')
        @include('partials.footer')
    </div>
    @include('partials.scripts')
</body>

</html>
