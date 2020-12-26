@extends('layout.default')

@section('title')
  Ny bruger
@endsection

@section('fixed-navtitle')
  Ny bruger
@endsection

@section('content')
  <div class="container">
    <h1>Ny bruger</h1>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group">
          {{ Form::open(array('route' => 'postregister')) }}

              <div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' }}">
              {{ Form::label('Brugernavn') }}
              {{ Form::text('username', '', array('class' => 'form-control', 'required' => 'required')) }}
              @if ($errors->has('username'))
              	<strong>
              		{{ $errors->first('username') }}
              	</strong>
              @endif
              </div>

              <br><hr><br>
              <div class="form-group {{ ($errors->has('pass1')) ? 'has-error' : '' }}">
      				{{ Form::label('Kodeord') }}
      				{{ Form::password('pass1', array('class' => 'form-control', 'required' => 'required')) }}
      				@if ($errors->has('pass1'))
      					<strong>
      						{{ $errors->first('pass1') }}
      					</strong>
      				@endif
      				</div>


      				<div class="form-group {{ ($errors->has('pass2')) ? 'has-error' : '' }}">
      				{{ Form::label('Skriv Kodeord igen') }}
      				{{ Form::password('pass2', array('class' => 'form-control', 'required' => 'required')) }}
      				@if ($errors->has('pass2'))
      					<strong>
      						{{ $errors->first('pass2') }}
      					</strong>
      				@endif
      				</div>

              <br>
              {{ Form::submit('Gem', array('class' => 'btn btn-info btn-block')) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection
