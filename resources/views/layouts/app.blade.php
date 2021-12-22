<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @guest
        <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    @endguest
    @stack('styles')
    <title>{{ $title ?? 'Laramerce' }}</title>
  </head>
  <body @guest class="text-center" @endguest>

    @guest
        @yield('content')
    @else
        <x-navbar></x-navbar>
        @yield('content')
    @endguest

    <script src="{{ asset('js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @stack('script')
  </body>
</html>