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
            <div class="col-md-10">
                {{$searchProduct[$i]->get('barcode')}} {{$searchProduct[$i]->get('name')}}
            </div>
            <div class="col-md-2">
                <a href="{{URL::current().'/'.$searchProduct[$i]->get('id')}}"><button type="button" class="btn btn-default">add</button></a>
            </div>
        @endfor
    </div>

@stop