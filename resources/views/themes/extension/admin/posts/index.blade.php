<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-primary">

  <div class="panel-heading">
    <h1 class="panel-title">
        <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;&nbsp;Posts 
        <a href="/{{ config('letsblog.app.admin_path') }}/posts/create" role='button' class='btn btn-success btn-xs pull-right'>New Post</a>
    </h1>
  </div>

  <div class="table-responsive">
    <table class='table table-hover table-striped'>
      <thead>
        <tr>
          <th>Title</th>
          <th>Published</th>
          <th>Created</th>
          <th>Updated</th>
          <th></th>
        </tr>
      </thead>
  
      @foreach ($posts AS $p)
        <tr>
          <td><a href="/posts/{!! $p->slug !!}" target="_blank">{{ $p->title }}</a></td>
          <td>
            @if ( ! empty($p->published_at) AND $p->published_at->timestamp < strtotime('now'))
              <span style="color:darkgreen;">{{ $p->published_at->format('Y-m-d') }}</span>
            @elseif ( ! empty($p->published_at) AND $p->published_at->timestamp > strtotime('now'))
              <span style="color:darkblue;">{{ $p->published_at->format('Y-m-d H:i:s') }}</span>
            @else
              <span style="color:darkred;"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Unpublished</span>
            @endif
          </td>
          <td>{{ $p->created_at->format('Y-m-d H:i:s') }}</td>
          <td>{{ $p->updated_at->format('Y-m-d H:i:s') }}</td>
          <td><a href="/{{ config('letsblog.app.admin_path') }}/posts/{{ $p->id }}/edit"><input type='button' class='btn btn-xs btn-primary' value="Edit Post"></a></td>
        </tr>
      @endforeach
  
    </table>
  </div>

    </div>
  </div>
</div>
