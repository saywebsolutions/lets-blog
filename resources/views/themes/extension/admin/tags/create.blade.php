@extends('layouts/admin')

@section('content')

      <h1>Create Post</h1><hr>

      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {!! Form::open(array('url' => 'admin/posts')) !!}

        <div class='form-group'>
          {!! Form::label('title', 'Title') !!}
          {!! Form::text('title', null, array('class' => 'form-control')) !!}
        </div>
 
        <div class='form-group'>
          {!! Form::label('slug', 'Slug') !!}
          {!! Form::text('slug', null, array('class' => 'form-control')) !!}
        </div>
  
        <div class='form-group'>
          {!! Form::label('keywords', 'Keywords') !!}
          {!! Form::text('keywords', null, array('class' => 'form-control')) !!}
        </div>
  
        <div class='form-group'>
          {!! Form::label('meta', 'Meta') !!}
          {!! Form::text('meta', null, array('class' => 'form-control')) !!}
        </div>
  
        <div class='form-group'>
          {!! Form::label('body', 'Body') !!}
          {!! Form::textarea('body', null, array('class' => 'form-control')) !!}
        </div>
  
        {!! Form::submit('Create Post', array('class' => 'btn btn-primary')) !!}
          &nbsp;or&nbsp;
        <a href="{!! url()->to('/admin/posts') !!}" class="btn btn-default">Cancel</a>

      {!! Form::close() !!}

    </div>
  </div>
</div>

@stop

@section('javascript')
@stop
