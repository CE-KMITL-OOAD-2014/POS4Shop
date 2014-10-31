@extends('layout')

@section('head')
    <title>POS4Shop - Search</title>
@stop

@section('body')
    @if ($search!=null)
        <div class="row">
                <div class="alert alert-success">
                    <h3>Search : {{$search}}</h3>
                </div>
        </div>
    @endif
    
    
    <div class="row">
        @for ($i=0;$i<count($searchProduct);$i++)
            <div class="col-md-2">
                <img src="upload/product/{{$searchProduct[$i]->get('file')}}" class="img-responsive" alt="Image">
                {{$searchProduct[$i]->get('name')}} <br>
            </div>
        @endfor
    </div>

@stop