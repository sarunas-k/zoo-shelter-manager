<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- API Token -->
    <script>
      window.Laravel = {!! json_encode([
          'apiToken' => auth()->user()->api_token ?? null,
      ]) !!};
   </script>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Animal shelter | @yield('title')</title>
  </head>
  <body>
    <div id="app">
        @include('partials/navbar-top')
        <div class="container-fluid">
            <div class="row">
                @include('partials/navbar-side')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    @yield('content')
                </main>
            </div>
          </div>
    </div>
    <!-- Optional JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('js/feather.min.js') }}"></script>
    <script type="text/javascript">window.addEventListener('load', () => feather.replace())</script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    @yield('scripts')
  </body>
</html>