<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>電商平台</title>
    {{-- < link rel="icon" href="/favicon.ico" type="image/x-icon" / > --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">        
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link active" aria-current="page" href="/">商品列表</a>
                  <a class="nav-link" href="/contact_us">聯絡我們</a>
                </div>
              </div>
              <div>
                <input type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notifications" value="通知"/>
              </div>
            </div>
        </nav>
          @include('layouts.modal')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
