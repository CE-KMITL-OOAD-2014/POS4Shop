@extends('layout')

@section('head')
    <title>{{App::make('ceddd\Shop')->getName()}} - 404</title>    
@stop

@section('body')
    <div class="well">
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>404 Not found !</strong>
        
    </div>
    </div>
@stop