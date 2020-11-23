<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>Sales Dashboard - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  </head>
  <body>
    <div class="container">
      @yield('content')
    </div>
  </body>
</html>