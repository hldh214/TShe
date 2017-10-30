<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="{{ env('THEME_COLOR') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', env('APP_NAME'))</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('index') }}">首页</a></li>
                        <li><a href="{{ route('guide') }}">轻松上手</a></li>
                        <li><a href="{{ route('stories') }}">T-show</a></li>
                        <li><a href="{{ route('topics') }}">更多专题</a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li><a href="{{ route('items.create') }}">一件起定</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('orders.index') }}">我的订单</a></li>
                                    <li><a href="{{ route('cart.index') }}">我的购物车</a></li>
                                    <li><a href="{{ route('home') }}">个人中心</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            退出
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <div class="container">
            <div class="list-group">
                <a href="{{ route('index') }}" class="list-group-item">
                    首页
                    <span class="pull-right glyphicon glyphicon-chevron-right"></span>
                </a>
                <a class="list-group-item" href="{{ route('guide') }}">
                    轻松上手
                    <span class="pull-right glyphicon glyphicon-chevron-right"></span>
                </a>
                <a class="list-group-item" href="{{ route('stories') }}">
                    T-show
                    <span class="pull-right glyphicon glyphicon-chevron-right"></span>
                </a>
                <a class="list-group-item" href="{{ route('topics') }}">
                    更多专题
                    <span class="pull-right glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>

            <div class="copyright">
                <p>Copyright &copy; 2017 xxx有限公司</p>
                <p>沪公网安备00000000000001号</p>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')
</body>
</html>
