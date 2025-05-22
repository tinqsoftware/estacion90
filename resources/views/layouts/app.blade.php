<!doctype html>
<html class="no-js" lang="zxx">

<head>
    @include('layouts.partials.head')
</head>

<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('layouts.partials.footer-scripts')

</body>

</html>
