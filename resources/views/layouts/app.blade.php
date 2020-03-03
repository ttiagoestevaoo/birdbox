<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div id="app">
        
    
        @auth
        <div class="lg:float-left lg:w-1/12 md:w-2/12 bg-gray-900 md:bg-gray-900  text-center w-full fixed bottom-0 md:pt-8 md:top-0 md:left-0 h-16 md:h-screen">
            <div class="relative mx-auto">
                <ul class="list-reset flex flex-row md:flex-col text-center md:text-left">
                    <li class="mr-3 flex-1">
                        <a href="#" class="sidebar-item">
                        <i class="fas fa-link pr-0 md:pr-3"></i><span class="sidebar-text">Agenda</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="/projects" class="sidebar-item">
                        <i class="fas fa-link pr-0 md:pr-3"></i><span class="sidebar-text">Projects</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="/tasks" class="sidebar-item">
                        <i class="fas fa-link pr-0 md:pr-3 text-pink-500"></i><span class="sidebar-text">Tasks</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
         </div>
       
        
         @endauth
    
        
<div class="@auth  md:float-right md:w-10/12 lg:w-11/12 @endauth">
    

         
        <nav class="bg-white shadow-sm px-10 w-full">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-3">
                    <h1>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </h1>
                    
                    <div>                       

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                        </div>
                    </div>
                
                </div>
        </nav>
        
        <main class="px-10 py-5 w-full"><!--Sidebar-->
            

            @yield('content')
        
        </main>
        </div>
    </div>
</body>
</html>
