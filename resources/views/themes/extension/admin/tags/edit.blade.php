@extends('layouts/admin')

@section('content')

    <h1>Edit Tag</h1><hr>

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {!! Form::model($tag, ['route' => ['admin.tags.update', $tag->id], 'method' => 'PUT']) !!}

    <div class="form-group">
      {!! Form::label('name', 'Name') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('slug', 'Slug') !!}
      {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('count', 'Count') !!}
      {!! Form::text('count', null, ['class' => 'form-control', 'readonly']) !!}
    </div>

    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
    &nbsp;or&nbsp;
    <a href="{!! url()->to('/admin/tags') !!}" class="btn btn-default">Cancel</a>

    {!! Form::close() !!}
    
    </div>

  </div>

</div>

@stop


@section('javascript')
<script>


</script>
@stop
