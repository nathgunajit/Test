@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Tip</div>
        <div class="panel-body">
          {{ Form::model($data, ['route' => ['tips.update', $data->id], 'method' => 'patch', 'class' =>'form-horizontal']) }} 
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-3 control-label">Title</label>
            <div class="col-md-7">
              <input id="title" type="text" class="form-control" name="title" value="{{ $data->title }}" required autofocus>
              @if ($errors->has('title'))
              <span class="help-block">
              <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('tips') ? ' has-error' : '' }}">
            <label for="tips" class="col-md-3 control-label">Tips Description</label>
            <div class="col-md-7">
              <textarea id="tips" rows="6" class="form-control" name="tips" required>{{ $data->tips }}</textarea>
              @if ($errors->has('tips'))
              <span class="help-block">
              <strong>{{ $errors->first('tips') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-7 col-md-offset-3">
              <button type="submit" class="btn btn-primary btn-block">
              Update
              </button>
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection	