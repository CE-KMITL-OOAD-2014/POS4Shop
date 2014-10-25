@extends('layout')

@section('head')
    <title>POS4Shop - view</title>    
@stop

@section('body')
    <div class="well">
        Barcode : {{$product->get('barcode')}} <br>
        Name : {{$product->get('name')}} <br>
        <img src="/upload/product/{{$product->get('file')}}" class="img-responsive" alt="Image">
    </div>
@stop