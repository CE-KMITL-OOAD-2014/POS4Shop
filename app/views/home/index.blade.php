@extends('layout')

@section('head')
    <title>POS4Shop - Home</title>
@stop

@section('body')
    
    @for ($i=0;$i<count($allProduct);$i++)
        <img src="upload/product/{{$allProduct[$i]->get('file')}}" class="img-responsive" alt="Image">
        {{$allProduct[$i]->get('name')}} <br>
    @endfor

@stop