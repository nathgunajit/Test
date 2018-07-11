@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-10">
              <strong>All Tips Listing</strong>
            </div>
            <div class="col-md-2">
              <a href="{{ URL::route('tips.create') }}" class="btn btn-info pull-right">Add Tips</a>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <tr>
              <th>Title</th>
              <th width="500">Tips Description</th>
              <th width="180" class="text-center">Action</th>
            </tr>
            @if(!empty($data) && $data->count())
            @foreach($data as $key => $value)
            <tr>
              <td>{{ $value->title }}</td>
              <td>
                @if (strlen($value->tips) > 100)
                {!! substr(strip_tags(html_entity_decode($value->tips)), 0, 100) . '.....' !!}
                @else
                {!! strip_tags($value->tips) !!}
                @endif
              </td>
              <td class="text-center">
                <a href="{!! URL::route('tips.edit', $value->id) !!}" class="btn btn-success">Edit</a>
                <a data-toggle="modal" data-url="{!! URL::route('tips.destroy', $value->id) !!}" data-id="{{$value->id}}" data-target="#custom-width-modal" class="btn btn-danger remove-record">Delete</a>
              </td>
            </tr>
            @endforeach
            @endif
          </table>
        </div>
      </div>
      {!! $data->appends([])->render() !!}
    </div>
  </div>
</div>
@endsection