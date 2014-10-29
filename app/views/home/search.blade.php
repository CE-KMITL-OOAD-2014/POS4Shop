@extends('layout')

@section('head')
    <title>POS4Shop - Search</title>
@stop

@section('body')
    
    @for ($i=0;$i<count($searchProduct);$i++)
        <img src="upload/product/{{$searchProduct[$i]->get('file')}}" class="img-responsive" alt="Image">
        {{$searchProduct[$i]->get('name')}} <br>
    @endfor

@stop