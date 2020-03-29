@extends('home.layout')
@section('content')
    @parent
    <div class="row">
        <div class="col-12">
            <div class="card mt-10" >
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{ $article->title }}</h2>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <small class="text-muted"><i class="iconfont icon-user"></i>{{ $article->user['name'] }}</small>
                            <small class="text-muted"><i class="iconfont icon-riqi2"></i>{{ $article->created_at }}</small>
                            <small class="text-muted"><i class="iconfont icon-category"></i><a href="{{ url('category',$article->category['id']) }}">{{ $article->category['catename'] }}</a></small>
                            <small class="text-muted"><i class="iconfont icon-view"></i>{{ $article->views }}</small>
                        </h6>
                        <p class="card-text">
                            {!! $article->content; !!}
                        </p>
                        <p class="card-text">
                            <small class="text-muted"><i class="iconfont icon-tag"></i>
                                @foreach($article->tags as $v)
                                    <a href="{{ url('tag',$v->id) }}">{{ $v->tagname }}
                                @endforeach
                            </small>
                        </p>
                        <p>
                            @if (empty($prev))
                                <a href="javascript:void(0)" class="card-link">上一篇：没有了</a>
                            @else
                                <a href="{{ url('article',[$prev->id]) }}" class="card-link">上一篇：{{ $prev->title }}</a>
                            @endif
                        </p>
                        <p>
                            @if (empty($next))
                                <a href="javascript:void(0)" class="card-link">下一篇：没有了</a>
                            @else
                                <a href="{{ url('article',[$next->id]) }}" class="card-link">下一篇：{{ $next->title }}</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
