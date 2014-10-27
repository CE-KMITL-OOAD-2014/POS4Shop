@extends('layout')

@section('head')
    <title>POS4Shop - Manager::view</title>    
@stop

@section('body')
    <div class="well">
        Name : {{$manager->get('name')}} <br>
        Userame : {{$manager->get('username')}} <br>

        <button type="button" class="btn btn-danger">edit</button>
        <button type="button" class="btn btn-danger">del</button>
    </div>
@stop