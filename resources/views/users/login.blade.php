@extends('layout.basic')

@section('title')
    Login
@endsection

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <div class="cmspage-bg">
              <h1>Hi ! Login here:</h1>
              <hr>
              {{ Form::open(array('route' => 'postLogin')) }}
                  <div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' }}">
                  {{ Form::label('Username') }}
                  {{ Form::text('username', '', array('class' => 'form-control', 'required' => 'required')) }}
                  @if ($errors->has('username'))
                      <strong>
                          {{ $errors->first('username') }}
                      </strong>
                  @endif
                  </div>

                  <br>

                  <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                  {{ Form::label('Password') }}
                  {{ Form::password('password', array('class' => 'form-control', 'required' => 'required')) }}
                  @if ($errors->has('password'))
                      <strong>
                          {{ $errors->first('password') }}
                      </strong>
                  @endif
                  </div>
                  {{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
              {{ Form::close() }}
          </div>
      </div>
  </div>
</div>
@endsection
