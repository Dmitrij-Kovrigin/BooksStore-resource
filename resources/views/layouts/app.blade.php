<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Books and Outfits store</title>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-info bg-white shadow-sm">

            <div class="container background">

                <a class="navbar-brand " href="{{ url('/') }}">

                    <h2 style="color:black;text-shadow: 2px 2px 5px green;"><i class="fas fa-dragon" style="font-size:45px;color:red;"></i> Books and Outfits store</h2>

                    {{-- {{ config('app.name', 'Books and Outfits store') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>Authors</b>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right background" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ asset('/authors?sort=new_asc') }}">
                                    <b>Authors List</b>
                                </a>
                                <a class="dropdown-item" href="{{ route('author_create') }}">
                                    <b>New Author</b>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>Books</b>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right background" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('book_index') }}">
                                    <b>Books List</b>
                                </a>
                                <a class="dropdown-item" href="{{ route('book_create') }}">
                                    <b>New Book</b>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>Tags</b>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right background" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('tag_index') }}">
                                    <b>Tags List</b>
                                </a>
                                <a class="dropdown-item" href="{{ route('tag_create') }}">
                                    <b>New Tag</b>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b>Outfits</b>


                            </a>
                            <div class="dropdown-menu dropdown-menu-right background" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('outfit_index') }}">
                                    <b>Outfits List</b>


                                </a>
                                <a class="dropdown-item" href="{{ route('outfit_create') }}">
                                    <b> New Outfit</b>


                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <b> Brands</b>


                            </a>
                            <div class="dropdown-menu dropdown-menu-right background" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('brand_index') }}">
                                    <b>Brands List</b>


                                </a>
                                <a class="dropdown-item" href="{{ route('brand_create') }}">
                                    <b>New Brand</b>


                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    @if ($errors->any())
                    <div class="alert">
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    @if(session()->has('success_message'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success_message')}}
                    </div>
                    @endif

                    @if(session()->has('info_message'))
                    <div class="alert alert-info" role="alert">
                        {{session()->get('info_message')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
