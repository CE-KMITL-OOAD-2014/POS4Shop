@extends('layout')

@section('head')
    <title>{{App::make('ceddd\Shop')->getName()}} - 404</title>    
@stop

@section('body')
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h1>404 Not found !</h1>
        
    </div>
@stop