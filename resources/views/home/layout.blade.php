<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('blog.name') }}</title>
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        {{--<script src="{{ asset('mix/app.js') }}"></script>--}}
        <link rel="stylesheet" href="{{ asset('css/style.css?t='.time()) }}">
        <link rel="stylesheet" href="{{ asset('css/timeline.css?t='.time()) }}">
        <link rel="stylesheet" href="//at.alicdn.com/t/font_1650646_10nwvaw8o78.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    </head>
    <body>

    <!-- 顶部开始 -->
    <div class="container-fluid top-bg fixed-top">
        @include('home.components.top')
    </div>
    <!-- 顶部结束 -->

    <!-- 内容开始 -->
    <div class="container mt-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8">
                    @yield('content')
                </div>

                <div class="col-0 col-md-4">
                    @include('home.components.sidebar')
                </div>
            </div>
        </div>
    </div>
    <!-- 内容结束 -->

    <!-- 底部开始 -->
    <div class="container-fluid mt-2 footer-bg" style="min-height:50px;text-align: center;font-size:14px">
        <div class="row">
            <div class="col-12">
                @include('home.components.footer')
            </div>
        </div>
    </div>
    <!-- 底部结束 -->

    {{--@include('home.components.timeline')--}}
    </body>
</html>
