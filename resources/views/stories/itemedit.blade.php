@extends('layout.default')

@section('title')
    New custom item
@endsection

@section('content')
<style media="screen">
  .locationname {
    font-size: 25px;
    height: 40px;
  }
</style>
{{ Form::open(array('route' => 'posteditcustomitem', 'files' => true)) }}
{{ Form::hidden('id', $data->id) }}
{{ Form::hidden('story_id', $data->story_id) }}
<div class="container">
  <div class="row">
    <div class="col-sm-10">
      <h3>New Custom story item</h3>
    </div>
    <div class="col-sm-2">
      {{ Form::submit('Gem', array('class' => 'btn btn-primary btn-block')) }}
    </div>
  </div>

  <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
  {{ Form::text('name', $data->name, array('class' => 'form-control locationname', 'placeholder' => 'Item Name')) }}
  @if ($errors->has('name'))
      <strong>
          {{ $errors->first('name') }}
      </strong>
  @endif
  </div>

  {{ Form::label('Item description') }}
  <div class="form-group {{ ($errors->has('text')) ? 'has-error' : '' }}">
    {{ Form::textarea('text', $data->notes, array('class' => 'form-control', 'placeholder' => "it's a good idea to make it as brief as possible", 'style' => 'height:100px;')) }}
    @if ($errors->has('text'))
        <strong>
            {{ $errors->first('text') }}
        </strong>
    @endif
  </div>

  {{ Form::label('Replace Item Symbol (Max size allowed is 512x512 pixels)') }}
  <div class="form-group {{ ($errors->has('image')) ? 'has-error' : '' }}">
    {{ Form::file('image', array('class' => 'form-control')) }}
  @if ($errors->has('image'))
      <strong>
          {{ $errors->first('image') }}
      </strong>
  @endif
  </div>

  @if (empty($data->img))
    <h1>No Image</h1>
  @else
    <img src="{{$data->img}}" width="100%" style="max-width:512px" alt="">
  @endif

  <br><br>
  <a href="/delete/stories/item/{{$data->id}}" class="btn btn-danger btn-block">Delete item</a>
  <br><br>

</div>
{{ Form::close() }}
@endsection
