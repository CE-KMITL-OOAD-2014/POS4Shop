@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Home</title>
@stop

@section('body')
<?php 
//var_dump($allProduct);
//exit();
?>
<div class="well">
  <div class="row">

    @for ($i=0;$i<count($allProduct);$i++)
    <a href="{{URL::to('/product/'.$allProduct[$i]->get('id'))}}">
      <div class="col-md-2">
        <p style="text-align:center">
          <img src="/upload/product/{{$allProduct[$i]->get('file')}}" style="max-height:80px">
        </p>
        <p class="text-center" style="text-align:center,z-index:1">{{$allProduct[$i]->get('name')}} ({{ substr($allProduct[$i]->get('price'),0,-5) }}฿)</p>
      </div>
    </a>
    @endfor
  </div>
</div>
@stop