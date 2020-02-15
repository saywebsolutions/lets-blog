<div class="panel panel-default">

    <div class="panel-heading">
        <h1 class="panel-title">
            <a href="{{ route('tags') }}"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;{{ $title or 'Tags' }}:</a>
        </h1>
    </div>

    <ul class="list-group">
        @foreach ($tags as $t)
            <a class="list-group-item" href="{{ $t->url }}">{{ $t->name }}
                <span class="badge">{{ $t->posts_count }}</span>
            </a>
        @endforeach
    </ul>

</div>
