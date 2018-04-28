<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h1 class="panel-title">
          <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit Post
          <a href="/{{ config('letsblog.app.admin_path') }}/posts" role='button' class='btn btn-success btn-xs pull-right'>All Posts</a>
          <a class="btn btn-success btn-xs pull-right" role="button" href="/posts/{{ $post->slug }}" target="_blank">View Post</a>
        </h1>
      </div>

      <div class="panel-body">

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {!! Form::open(['url' => '/' . config('letsblog.app.admin_path') . '/posts/' . $post->id, 'method' => 'PUT']) !!}

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title', $post->title) }}">
    </div>

    <div class="form-group">
      <label for="slug">Slug</label>
      <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug', $post->slug) }}">
    </div>

    <div class="form-group">
        <label for="keywords">Keywords</label>
        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords" value="{{ old('keywords', $post->keywords) }}">
    </div>

    <div class="form-group">
        <label for="meta">Meta / Description</label>
        <input type="text" class="form-control" id="meta" name="meta" placeholder="Meta / Description" value="{{ old('meta', $post->meta) }}">
    </div>


  <div id="type_div" class="form-group">
    <label>Type</label>
    <input disabled type="hidden" name="type" id="type_new" class="form-control" placeholder="Enter a type here..." value="">
    <select name="type" id="type" class="form-control">
      @foreach($types as $t) 
        <option @if($post->type == $t) selected @endif value="{{ $t }}">{{ $t }}</option>
      @endforeach
      <option value="new">Add new type</option>
    </select>
  </div>


    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="{{ $post->type }}" name="body">{{ old('body', $post->body) }}</textarea>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input type='text' class='form-control' id='tags' name='tags' value="{{ old('tags', $tags) }}">
    </div>

    <div class="form-group">
      <label for="published_at">Publish Date</label>
      <input type='text' class='form-control' id='published_at' name='published_at' placeholder="Format: YYYY-MM-DD" value="{{ $post->published_at }}">
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
    &nbsp;or&nbsp;
    <a href="{!! url()->to('/admin/posts') !!}" class="btn btn-default">Cancel</a>

{!! Form::close() !!}
    
    </div>
    </div>

  </div>

</div>


@section('javascript')

  <script type="text/javascript">

    $('#type').on('change', function (e) {
      if(this.value == 'new')
      {
        $("#type").prop('disabled', true);
        $("#type").hide();
        $("#type_new").prop('disabled', false);
        $("#type_new").prop('type', 'text');
      }
    });

  </script>

  @if ($post->type == 'wysiwyg')
  
    @include ('letsblog::shared/backend/parts/tinymce')

  @endif
      
@stop
