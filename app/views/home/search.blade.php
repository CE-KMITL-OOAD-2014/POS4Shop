@extends('layout')

@section('head')
    <title>{{App::make('ceddd\Shop')->getName()}} - Search</title>
@stop

@section('body')
    @if ($search!=null)
        <div class="row">
                <div class="alert alert-success">
                    <h4>Search : {{$search}}</h4>
                </div>
        </div>
    @endif
    
    <div class="well">
        <div class="row">

        @for ($i=0;$i<count($searchProduct);$i++)
        <a href="{{URL::to('/product/'.$searchProduct[$i]->get('id'))}}">
          <div class="col-md-2">
            <p class="text-center">
          <img src="/upload/product/{{$searchProduct[$i]->get('file')}}" style="max-height:80px"></p>
            <p class="text-center" style="z-index:1">{{$searchProduct[$i]->get('name')}} ({{ substr($searchProduct[$i]->get('price'),0,-5) }}฿)</p>
          </div>
        </a>
        @endfor
        </div>
    </div>
    
@stop