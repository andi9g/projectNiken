<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ url('bootstrap/bootstrap.min.css', []) }}">
    <link rel="stylesheet" href="{{ url('bootstrap/mycss.css', []) }}">
    <link rel="stylesheet" href="{{ url('/css/mycss.min.css', []) }}">

    <title>@yield('judul')</title>
  </head>
  <body class="bg-light" style="background: url('{{ url('/background', 'bg.jpg') }}')">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
        <div class="container pt-2">

            <a class="navbar-brand text-bold mb-1" href="#"><b>MONITORING PH</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link @yield('activeWelcome')" href="{{ url('welcome', []) }}">Halaman Utama</a>
                    <a class="nav-link @yield('activeAdmin')" href="{{ url('admin', []) }}">Data Admin</a>
                    <a class="nav-link @yield('activePerangkat')" href="{{ url('perangkat', []) }}">Perangkat</a>
                    <a class="nav-link @yield('activePerangkat') text-danger" href="{{ url('logout', []) }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="card text-left ">
          {{-- <img class="card-img-top" src="holder.js/100px180/" alt=""> --}}
          @yield('content')
          
        </div>
    </div>




    
    <script src="{{ url('bootstrap/jquery.slim.min.js', []) }}"></script>
    <script src="{{ url('bootstrap/bootstrap.bundle.min.js', []) }}"></script>
    <script src="{{ url('jquery.min.js', []) }}"></script>
    @include('sweetalert::alert')

    @yield('myScript')

  </body>
</html>