<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @yield('title')
        </title>

        {{-- Bootstrap --}}
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
        {{-- Font awesome --}}
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" >
        {{-- custom styles --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" >

        @yield('css')

    </head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}"><b>{{ config('app.name', '') }}</b></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class='nav navbar-nav navbar-right'>
                        @guest
                            <li class="">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class=" dropdown">
                                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @endguest
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>

        <main class="py-4">

            <div class="container panel-container">

                <div class="row">
                    @auth
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="{{ route('posts.index') }}">Post <span class="fa fa-edit"></span></a> </li>
                                <li class="list-group-item"><a href="{{ route('categories.index') }}">Category <span class="fa fa-edit"></span></a> </li>
                                <li class="list-group-item"><a href="{{ route('tags.index') }}">Tags <span class="fa fa-tags"></span></a> </li>
                            </ul>
                            <hr>

                             <ul class="list-group">
                                <li class="list-group-item"><a href="{{ route('trashed-posts.index') }}">Trashed Posts <span class="fa fa-trash-o"></span></a> </li>
                            </ul>
                        </div>

                    <div class="col-md-8">

                    {{-- Flash messages --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success')  }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            <b>{{ session()->get('error')  }}</b>
                        </div>  
                    @endif
                    
                    {{-- category custom error flash message with link --}}
                    @if (session()->has('cat-error'))
                        <div class="alert alert-danger">
                            <b>{{ session()->get('cat-error')  }} <a href="{{ route('categories.create') }}" class="btn btn-success btn-xs">add caregory</a></b>
                        </div>
                    @endif

                        @yield('content')
                    </div>


                    @else
                        @yield('content')
                    @endauth
                </div>
            </div>
        </main>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
