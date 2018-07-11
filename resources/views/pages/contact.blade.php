@extends('layouts.default')
@section('content')
    <form action="{{ url('contact')}}" method="post">
		{{csrf_field()}}
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Subject:</label>
    <input type="text" class="form-control" name="subject" id="pwd">
  </div>
<div class="form-group">
    <label for="pwd">Message:</label>
    <input type="text" class="form-control" name="message" id="pwd">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>


@stop