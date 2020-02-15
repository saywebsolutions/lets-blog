<h1 class="first">Tags</h1>

<br/>


<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cloud" aria-controls="tag-cloud" role="tab" data-toggle="tab">Cloud</a></li>
    @foreach ($formats as $f)
      <li role="presentation"><a href="#{{ $f['id'] }}" aria-controls="{{ $f['id'] }}" role="tab" data-toggle="tab">{{ $f['label'] }}</a></li>
    @endforeach
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="cloud">

        <div class="text-lg text-center">
           @forelse ($tags as $t)
               @if ($t->posts_count > 0)
                   <a style="margin: 5px 2px;" href="{{ $t->url }}" class="btn
                   @if ($t->posts_count <= 1)
                       btn-sm
                   @elseif ($t->posts_count > 1 && $t->posts_count <= 3)
                       btn-md
                   @elseif ($t->posts_count >= 4)
                       btn-lg
                   @endif
                   btn-info">{{ $t->name }} ({{ $t->posts_count }})</a>
               @endif
           @empty
               No tag(s) found.
           @endforelse
        </div>

    </div>

    @foreach ($formats as $f)

    <div role="tabpanel" class="tab-pane" id="{{ $f['id'] }}">

            <ul class="list-group">
                @forelse ($tags->{$f['sortFunction']}($f['sortField']) as $t)
                    @if ($t->posts_count > 0)
                        <a href="{{ $t->url }}" class="list-group-item">
                            <span class="badge">{{ $t->posts_count }}</span>
                            {{ $t->name }}
                        </a>
                    @endif
                @empty
                    No tag(s) found.
                @endforelse
            </ul>

    </div>

    @endforeach

  </div>

</div>
