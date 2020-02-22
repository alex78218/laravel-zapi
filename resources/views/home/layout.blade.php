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
        <link rel="stylesheet" href="//at.alicdn.com/t/font_1650646_10nwvaw8o78.css">
    </head>
    <body>

    <!-- 顶部开始 -->
    <div class="container-fluid top-bg fixed-top">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark top-bg">
                    <a class="navbar-brand" href="/">{{ config('blog.name') }}</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarToggler">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item @if (Route::currentRouteName()=='index') active @endif">
                                <a class="nav-link" href="{{ url('/') }}">首页</a>
                            </li>
                            @foreach($categories as $v)
                                @if (Route::currentRouteName()=='category' && request()->id==$v->id)
                                    <li class="nav-item active">
                                @else
                                    <li class="nav-item">
                                @endif
                                <a class="nav-link" href="{{ url('category',$v->id) }}">{{ $v->catename }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" name="kw" value="{{ request()->input('kw') }}" placeholder="输入搜索">
                            <button class="btn btn-success my-2 my-sm-0" type="submit">搜索</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- 顶部结束 -->

    <!-- 内容开始 -->
    <div class="container" style="margin-top: 70px;">
        <div class="row">
            <div class="col-12 col-md-8">
                    @foreach($list as $v)
                    <div class="row">
                        <div class="col-12">
                            <div class="card  mt-20" >
                                <div class="card-body">
                                    <a href="{{ url('article',$v->id) }}"><h5 class="card-title">{{ $v->title }}</h5></a>
                                    <p class="card-text">
                                        <small class="text-muted"><i class="iconfont icon-user"></i>{{ $v->user->name }}</small>
                                        <small class="text-muted"><i class="iconfont icon-riqi2"></i>{{ $v->created_at }}</small>
                                        <small class="text-muted"><i class="iconfont icon-category"></i>{{ $v->category->catename }}</small>
                                        <small class="text-muted"><i class="iconfont icon-view"></i>{{ $v->views }}</small>
                                    </p>
                                    <p class="card-text">{{ substr($v->content,0,50) }}</p>
                                    <p class="card-text">
                                        <small class="text-muted"><i class="iconfont icon-tag"></i>
                                            @foreach($v->tags as $tag)
                                                {{ $tag->tagname }}
                                            @endforeach
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <nav aria-label="Page navigation" class="mt-20">
                        <ul class="pagination justify-content-center">
                            {{ $list->appends(['kw'=>request()->input('kw')])->links() }}
                        </ul>
                    </nav>
            </div>

            <div class="col-0 col-md-4">
                <div class="row">
                    <div class="card  mt-20">
                        <div class="card-header">
                            标签
                        </div>
                        <div class="card-body">
                            @foreach($tags as $t)
                            <a href="{{ url('tag',$t->id) }}" class="btn btn-primary m-2">{{ $t->tagname }}({{ $t->articles_count }})</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card mt-20">
                        <div class="card-header">
                            归档
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- 内容结束 -->

    <!-- 底部开始 -->
    <div class="container-fluid mt-2 top-bg" style="min-height:50px;text-align: center;">
        <div class="row">
            <div class="col-12">
                <div class="align-middle align-self-center mx-auto">底部信息</div>
            </div>
        </div>
    </div>
    <!-- 底部结束 -->

    </body>
</html>
