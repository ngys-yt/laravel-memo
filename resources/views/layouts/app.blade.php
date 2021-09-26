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
    @yield('javascript')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- fontawesameの導入 --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
        </nav>

        {{-- 3カラムに変更 --}}
        <main class="">
            <div class="row">
                {{-- col-md-2 で横幅を2/12にする  p-0 でpaddingを0にする --}}
                <div class="col-sm-12 col-md-2 p-0">
                        <div class="card">
                            <div class="card-header">タグ一覧</div>
                            <div class="card-body my-card-body">
                                <a href="/" class="card-text d-block mb-2">すべて表示</a>

                        @foreach ($tags as $tag)
                            {{-- d-block ブロック要素になって縦並びになる --}}
                            <a href="/?tag={{$tag['id']}}" class="card-text d-block elipsis mb-2">{{ $tag['name']}}</a>
                        @endforeach
                            </div>
                        </div>
                </div>
                <div class="col-sm-12 col-md-4 p-0">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">メモ一覧 <a href="{{route('home')}}"><i class="fas fa-plus-square"></i></a></div>
                        <div class="card-body my-card-body">
                    {{-- メモの数だけ回す --}}
                    @foreach ($memos as $memo)
                            {{-- d-block ブロック要素になって縦並びになる --}}
                            <a href="/edit/{{$memo['id']}}" class="card-text d-block elipsis mb-2">{{ $memo['content']}}</a>
                    @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 p-0">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
