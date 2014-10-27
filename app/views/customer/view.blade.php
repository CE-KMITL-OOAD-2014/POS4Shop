@extends('layout')

@section('head')
    <title>POS4Shop - Customer::view</title>    
@stop

@section('body')
    <div class="well">
        Name : {{$customer->get('name')}} <br>
    
        <h2>HISTORY</h2>
        <button type="button" class="btn btn-primary">edit</button>
        <button type="button" class="btn btn-danger">del</button>
    </div>
@stop