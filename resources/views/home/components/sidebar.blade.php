<div class="row">
    <div class="col-12">
        <div class="card  mt-10">
            <div class="card-header">
                标签
            </div>
            <div class="card-body">
                @foreach($tags as $t)
                    <a href="{{ url('tag',$t->id) }}" class="btn btn-primary m-2">{{ $t->tagname }}&nbsp;({{ $t->article_count }})</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mt-10">
            <div class="card-header">
                归档
            </div>
            <ul class="list-group list-group-flush">
                @foreach($monthCal as $v)
                <li class="list-group-item">{{  $v->amonth }}&nbsp;({{ $v->acount }})</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
