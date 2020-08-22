
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
            <div id="post-wrapper">{!! $post->body !!}</div>
        @show
            
        @section ('post.related')
            @include (lb_view('components.related'))
        @show

    </div>
</div>

        @if ( ! empty(config('letsblog.comments.enabled', false)))
            <?php

                $comments = config('letsblog.comments.enabled', false);

                switch ($comments) {
                    case 'disqus':
                        if(config('app.env') === 'production'){
                        ?>

<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
var disqus_config = function () {
this.page.url = "{{ \Request::fullUrl() }}";  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = "{{ $post->slug }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://{{ config('letsblog.comments.'.$comments.'.shortname') }}.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                        <?php
                        }
                        break;
                    
                    default:
                        break;
                }
            ?>
        @endif

@push('scripts')

<script charset="utf-8">

$(document).ready(function() {                                                                          
    tableOfContents("#toc");
});

function tableOfContents(tocList) {                                                                            

    $(tocList).empty();
    var prevH2Item = null;
    var prevH2List = null;
    var index = 0;

    $("#post-wrapper h2, #post-wrapper h3").each(function() {

        //insert an anchor to jump to, from the TOC link.
        var anchor = "<a name='toc-"+index+"'></a>";
        $(this).before(anchor);
    
        var li = "<li><a href='#toc-"+index+"'>"+$(this).text()+"</a></li>";
    
        if( $(this).is("#post-wrapper h2") ){
            prevH2List = $("<ul></ul>");
            prevH2Item = $(li);
            prevH2Item.append(prevH2List);
            prevH2Item.appendTo(tocList);
        } else {
            prevH2List.append(li);
        }
        index++;
    });

    if(index > 0){
        $("#toc-panel").show();
    }

}   
</script>

@endpush
            
@section ('layout.sidebar')

        <div class="panel panel-default" id="toc-panel" style="display:none;">

            <div class="panel-heading">
                <h1 class="panel-title">
                    <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Table of Contents:
                </h1>
            </div>

            <div class="panel-body" style="padding-left: 0; padding-right: 5px;">
                <div>
                    <ul id="toc">
                    </ul>
                </div>
            </div>

        </div>

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

