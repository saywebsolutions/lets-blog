@section ('post.list')

    @forelse ($posts as $k => $p)

        <div class="col-xs-12 col-sm-6 post-panel">
            <div class="panel panel-info">

                <div class="panel-heading">
                    <h1 class="panel-title">
                        <a href="{{ $p->url }}">{{ $p->full_title }}</a>
                    </h1>
                </div>

                <div class="panel-body">
                    @if( ! empty($p->meta->image))
                        <a href="{{ $p->url }}">
                            <img class="thumbnail" src="{{ $p->img }}" style="width:85%; margin:0px;"/>
                        </a>
                    @endif
    
                    <p>
                        @foreach ($p->tags as $t)
                            <a href="{{ $t->url }}" class="btn btn-xs btn-primary">{{ $t->name }}</a>
                        @endforeach
    
                        @if ($p->series)
                            <a href="{{ $p->series->url }}" class="btn btn-xs btn-warning">{{ $p->series->title }}</a>
                        @endif
                    </p>
    
                    <p>
                        {{ $p->meta }}
                    </p>

                    <div class="post-panel-footer"><a href="{{ $p->url }}">Read</a><span class="text-muted pull-right">{{ $p->published_at->format('Y-m-d') }}<span></div>
    
                </div>
            </div>
        </div>

    @empty

        <div class="col-xs-12">
            <br/>No posts found.
        </div>

    @endforelse

    @if ($posts->total() > $posts->perPage())
        <hr/>

        {!! $posts->appends(request()->all())->render() !!}
    @endif

@show
