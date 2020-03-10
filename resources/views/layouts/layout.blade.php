<html>
<head>
<title>@yield('title')</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="{{asset('/css/reset.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/common.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/index.css ')}}"/>
    @yield('stylesheet')
    <style>
        #menu > li a{
            @if(!strcmp($initData[0]['lang'], 'ko'))
                padding: 13px 0;
            @else
                padding: 11px 0;
            @endif
        }
    </style>
</head>

<body>
    <div id="header">
        <table id="headerTbl" style="width:99%; margin:0 auto;">
            <tr>
                <td>
                    <!-- title -->
                    <h1><a href="{{route('index')}}">{{$initData[1]['label']->title[0]->title}}</a></h1>
                </td>
                <td>
                    <!-- user name -->
                    @if(Auth::check())
                    <span>{{ $initData[2]['user']->name}}</span>
                    @else
                    <span>guest</span>
                    @endempty
                </td>
                <td>
                    <!-- ログイン -->
                    @if(Auth::check())
                        <a href="{{route('logout')}}">LogOut</a>
                    @else
                        <a href="{{route('login')}}">Login</a>
                    @endempty
                </td>
                <td style="text-align:right;">
                    <!-- language -->
                    <select id="langList" name="lang" onchange="location.href='index/' + this.value;">
                        <option value="ja" {{ !strcmp($initData[0]['lang'], "ja") ? "selected" : ""}}>日本語</option>
                        <option value="ko" {{ !strcmp($initData[0]['lang'], "ko") ? "selected" : ""}}>한국어</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <div id="menu_div">
        <ui id="menu">
            <li><a href="#">{{$initData[1]['label']->menu[0]->menu01}}</a>
                <ul class="subMenu">
                    <li><a href="{{route('info')}}">{{$initData[1]['label']->subMenu[0]->subMenu01_01}}</a></li>
                    <li><a href="{{route('info.map')}}">{{$initData[1]['label']->subMenu[0]->subMenu01_02}}</a></li>
                </ul>
            </li>
            <li><a href="#">{{$initData[1]['label']->menu[0]->menu02}}</a>
                <ul class="subMenu">
                    <li><a href="{{route('menu')}}">{{$initData[1]['label']->subMenu[0]->subMenu02_03}}</a></li>
                    <li><a href="{{route('booking')}}">{{$initData[1]['label']->subMenu[0]->subMenu02_01}}</a></li>
                    <li><a href="{{route('booking.confirmList')}}">{{$initData[1]['label']->subMenu[0]->subMenu02_02}}</a></li>
                </ul>
            </li>
            <li><a href="{{route('gallery')}}">{{$initData[1]['label']->menu[0]->menu03}}</a></li>
            <li><a href="{{route('inquire')}}">{{$initData[1]['label']->menu[0]->menu04}}</a></li>
            <li><a href="{{route('review')}}">{{$initData[1]['label']->menu[0]->menu05}}</a></li>
        </ui>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        copyright 2020 laravel app
    </div>
</body>

</html>