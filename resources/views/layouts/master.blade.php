<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Ahmad Laundry</title>
  <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon"/>


  @stack('prepend-style')
  @include('includes.style')
  @stack('addon-style')


</head>

<body>
    <div class="preloader">
        <div class="loading text-center">
          <img src="{{ asset('img/preloader.gif') }}" width="150">
          <p>Harap Tunggu</p>
        </div>
      </div>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      @include('includes.navbar');

      @include('includes.sidebar');

      @yield('content')

      @include('includes.footer')
    </div>
  </div>

  @include('sweetalert::alert')
  @stack('prepend-script')
  @include('includes.script')
    <script>
    $(document).ready(function(){
    $(".preloader").delay(300).fadeOut();
    })
    </script>
  @stack('addon-script')
</body>
</html>
