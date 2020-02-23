@extends('home.layout')
@section('content')
    @parent
    @foreach($list as $v)
        <div class="row">
            <div class="col-12">
                <div class="card  mt-10" >
                    <div class="card-body">
                        <a href="{{ url('article',$v->id) }}"><h5 class="card-title">{{ $v->title }}</h5></a>
                        <p class="card-text">
                            <small class="text-muted"><i class="iconfont icon-user"></i>{{ $v->user->name }}</small>
                            <small class="text-muted"><i class="iconfont icon-riqi2"></i>{{ $v->created_at }}</small>
                            <small class="text-muted"><i class="iconfont icon-category"></i><a href="{{ url('category',$v->category->id) }}">{{ $v->category->catename }}</a></small>
                            <small class="text-muted"><i class="iconfont icon-view"></i>{{ $v->views }}</small>
                        </p>
                        <p class="card-text">{{ substr($v->content,0,50) }}</p>
                        <p class="card-text">
                            <small class="text-muted"><i class="iconfont icon-tag"></i>
                                @foreach($v->tags as $tag)
                                    <a href="{{ url('tag',$tag->id) }}">{{ $tag->tagname }}</a>
                                @endforeach
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row justify-content-center mt-20">
        <div class="col-12">
        {{ $list->appends(['kw'=>request()->input('kw'),'month'=>request()->input('month')])->render('home.components.pagination') }}
        </div>
    </div>

@endsection
