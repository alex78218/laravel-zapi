<div class="row">
    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                            <li class="nav-item @if (Route::currentRouteName()=='note') active @endif">
                                <a class="nav-link" href="{{ url('note') }}">小记</a>
                            </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="/">
                    <div class="input-group my-2">
                    <input class="form-control" type="search" name="kw" value="{{ request()->input('kw') }}" placeholder="输入搜索">
                    <div class="input-group-append">
                        <button class="btn btn-info my-2 my-sm-0" type="submit">搜索</button>
                    </div>
                    </div>
                </form>
            </div>
        </nav>
    </div>
</div>
