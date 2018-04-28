<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h1 class="panel-title">
          <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create Post
          <a href="/{{ config('letsblog.app.admin_path') }}/posts" role='button' class='btn btn-success btn-xs pull-right'>All Posts</a>
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

      {!! Form::open(['url' => '/' . config('letsblog.app.admin_path') . '/posts']) !!}

        <div class='form-group'>
          {!! Form::label('title', 'Title') !!}
          {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
 
        <div class='form-group'>
          {!! Form::label('slug', 'Slug') !!}
          {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        </div>
  
        <div class='form-group'>
          {!! Form::label('keywords', 'Keywords') !!}
          {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
        </div>
  
        <div class='form-group'>
          {!! Form::label('meta', 'Meta') !!}
          {!! Form::text('meta', null, ['class' => 'form-control']) !!}
        </div>

        <div id="type_div" class="form-group">
          <label>Type</label>
          <input disabled type="hidden" name="type" id="type_new" class="form-control" placeholder="Enter a type here..." value="">
          <select name="type" id="type" class="form-control">
            @foreach($types as $t) 
              <option @if('wysiwyg' == $t) selected @endif value="{{ $t }}">{{ $t }}</option>
            @endforeach
            <option value="new">Add new type</option>
          </select>
        </div>

        <div class="form-group">
          {!! Form::label('body', 'Body') !!}
          {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>
  
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
          &nbsp;or&nbsp;
        <a href="{!! url()->to(config('letsblog.app.admin_path') . '/posts') !!}" class="btn btn-default">Cancel</a>

      {!! Form::close() !!}

      </div>

    </div>
  </div>
</div>

@section ('javascript')

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

    $(function () {
      $('#datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        sideBySide: false
      });
    });
  </script>

  @include ('letsblog::shared/backend/parts/tinymce')

@stop
