<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PageKeeper </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <style>
    /* Default height for small devices */
    #intro-example {
      height: 400px;
    }

    /* Height for devices larger than 992px */
    @media (min-width: 992px) {
      #intro-example {
        height: 600px;
      }
    }
  </style>
    </head>
    <body >
        <header>
            <!-- Intro settings -->


            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                  data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false"
                  aria-label="Toggle navigation">
                  <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarExample01">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                      <a class="nav-link" aria-current="page" href="/" style="font-weight: 900;font-size: medium">PageKeeper</a>
                    </li>

                  </ul>
                </div>
              </div>
            </nav>
            <!-- Navbar -->

            <!-- Background image -->
            <div id="intro-example" class="p-5 text-center bg-image"
              style="background-image: url({{ asset('images/home.jpg') }}); background-size:cover; position:relative; height:93vh">
              <div class="mask w-100 h-100" style="background-color: rgba(0, 0, 0, 0.7);position: absolute;top:0;left:0;">
                <div class="d-flex justify-content-center align-items-center h-100">
                  <div class="text-white">
                    <h1 class="mb-3">“Every book opens the door to a new world."</h1>
                    <h5 class="mb-4">
                      start your reading jurney with PageKeeper ...
                    </h5>
                    @guest
                    @if (Route::has('login'))
                    <a class="btn btn-outline-light btn-lg m-2" href="{{ route('login') }}"
                      role="button" >Login</a>
                      @endif
                      @if (Route::has('register'))
                    <a class="btn btn-outline-light btn-lg m-2" href="{{ route('register') }}"
                      role="button">Register</a>
                      @endif
                    @else
                    <a class="btn btn-outline-light btn-lg m-2" href="{{ route('home') }}"
                    role="button">Dashboad</a>
                    @endguest

                  </div>
                </div>
              </div>
            </div>
            <!-- Background image -->
          </header>
    </body>
</html>
