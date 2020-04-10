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
<body class="bg-page theme-light">
    <div id="app">
    
        
<div class="">
 
        <nav class="text-default  bg-header shadow-sm px-10 w-full">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-3">
                    <h1>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </h1>
                    
                        <div class="">                       

                        <!-- Right Side Of Navbar -->
                       
                            <!-- Authentication Links -->
                            @guest
                              
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                               
                                @if (Route::has('register'))
                                    
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    
                                @endif
                            @else
                                    <theme-switcher> </theme-switcher> 
                                    <a id="navbarDropdown" class="mr-4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    
                                    <a class="" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                              
                            @endguest
                        
                        </div>
                    </div>
                
                </div>
        </nav>
        
        <main class="px-10 py-5 w-full">
            

            @yield('content')
        
        </main>
        </div>
    </div>
</body>
</html>
