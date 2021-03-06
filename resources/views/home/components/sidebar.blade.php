<div class="row">
    <div class="col-12">
        <div class="card  mt-10">
            <div class="card-header">
                标签
            </div>
            <div class="card-body">
                @foreach($tags as $k=>$t)
                    @php
                        $btnClass = ['btn-primary','btn-secondary','btn-success','btn-danger','btn-warning','btn-info'];
                    @endphp
                    <a href="{{ url('tag',$t->id) }}" class="btn {{ $btnClass[$k%count($btnClass)] }}" style="margin:3px;">{{ $t->tagname }}&nbsp;({{ $t->article_count }})</a>
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
                    <li class="list-group-item">
                        <a href="{{ url('/?month='.$v->amonth) }}">{{  $v->amonth }}&nbsp;({{ $v->acount }})</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
