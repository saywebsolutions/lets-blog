
<div class="panel panel-info">

    <div class="panel-heading">
        <h1 class="panel-title">
            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;<a href="{{ $post->url }}">{{ $post->full_title }}</a>
        </h1>
    </div>

    <div class="panel-body">

        @section ('post.head')
            
            <div class="text-muted">
            
                Posted {{ $post->published_at->format('Y-m-d') }}
            
                @foreach ($post->tags as $t)
                    @if ($loop->first) with tags @endif
                    <a href="{{ $t->url }}">{{ $t->name }}</a>@if ( ! $loop->last), @endif
                 @endforeach
            
                @if ($post->series)
                    as a part of the <a href="{{ $post->series->url }}">{{ $post->series->title }}</a> series
                 @endif
            
            </div>

            <hr style="margin-top:15px;">
            
        @show
            
        @section ('post.buttons')
            @include (lb_view('components.buttons'))
        @show
            
        @section ('post.body')
            <div>{!! $post->body !!}</div>
        @show
            
        @section ('post.related')
            @include (lb_view('components.related'))
        @show
            
    </div>

</div>
            
@section ('layout.sidebar')

    @if (@$post->series)

        <div class="panel panel-default">

            <div class="panel-heading">
                <h1 class="panel-title">
                    <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Series:
                </h1>
            </div>

            <ul class="list-group">
                @foreach ($post->series->posts as $p)
                    <a class="list-group-item" @if($post->url === $p->url) style="font-weight:bold;" @endif href="{{ $p->url }}">{{ $p->title }}</a>
                @endforeach
            </ul>

        </div>

    @endif

    @if ($post->tags)
        @include (lb_view('components.tags'), ['tags' => $post->tags()->withCount('posts')->get()])
    @endif

    @parent

@endsection

