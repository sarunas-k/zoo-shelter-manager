<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- User -->
    <meta name="current-user" content="{{ json_encode(['name' => Auth::user()->name, 'email' => Auth::user()->email, 'is_admin' => Auth::user()->isAdmin()]) }}">

    <!-- API Token -->
    <script>
      window.Laravel = {!! json_encode([
          'apiToken' => auth()->user()->api_token ?? null,
      ]) !!};
   </script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="../../../node_modules/bootstrap/dist/css/" rel="stylesheet"> --}}

    @stack('styles')

    <title>{{$appName}} | @yield('title')</title>
  </head>
  <body>
    <div id="app">
        @include('partials/navbar-top')
        <div class="container-fluid">
            <div class="row">
                @include('partials/navbar-side')
                <main role="main" class="col-md-9 ms-sm-auto col-lg-10">
                    @yield('content')
                </main>
            </div>
          </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('js/feather.min.js') }}"></script>
    <script type="text/javascript">window.addEventListener('load', () => feather.replace())</script>
    @yield('scripts')
    <script src="{{URL::asset('js/global.js')}}"></script>
  </body>
</html>