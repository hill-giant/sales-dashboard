<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>Cool Business - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <h1 class="navbar-brand px-3">Cool Business</h1>
    </nav>
    <main role="main" class="col-md-10 mx-sm-auto px-md-4">
      <div class="container-fluid bg-white">
        @yield('content')
      </div>
    </main>
  </body>
</html>