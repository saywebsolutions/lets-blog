<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-primary">

  <div class="panel-heading">
    <h1 class="panel-title">
      <i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Tags
      <a href="/{{ config('letsblog.app.admin_path') }}/tags/create" role='button' class='btn btn-success btn-xs pull-right'>Add Tag</a>
    </h1>
  </div>

    <div class="table-responsive">
      <table class='table table-striped table-condensed table-hover'>
        <thead>
          <tr>
            <th>Tag</th>
            <th>Count</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
          </tr>
        </thead>
  
        @foreach($tags AS $tag)
          <tr>
            <td><a href="/tags/{!! $tag->slug !!}" target="_blank">{{ $tag->name . ' (' . $tag->slug . ')' }}</a></td>
            <td>{{ $tag->count }}</td>
            <td>{{ date('Y-m-d H:i:s', strtotime($tag->created_at)) }}</td>
            <td>{{ date('Y-m-d H:i:s', strtotime($tag->updated_at)) }}</td>
            <td><a href="/admin/tags/{{ $tag->id }}/edit"><input type='button' class='btn btn-sm btn-primary' value="Edit Tag"></a></td>
          </tr>
        @endforeach
  
      </table>
    </div>
  </div>
  
    </div>
  </div>
</div>
