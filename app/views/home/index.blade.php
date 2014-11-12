@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Home</title>
@stop

@section('body')
<div class="well">
  <h3>สินค้าขายดี</h3>
  <div class="row">
    @for ($i=0;$i<count($top);$i++)
    <a href="/product/'{{$top[$i]->get('id'))}}">
      <div class="col-md-2">
        <p style="text-align:center">
          <img src="/upload/product/{{$top[$i]->get('file')}}" style="max-height:80px">
        </p>
        <p class="text-center" style="text-align:center,z-index:1">{{$top[$i]->get('name')}} ({{ substr($top[$i]->get('price'),0,-5) }}฿)</p>
      </div>
    </a>
    @endfor
  </div>
  <hr>
  <h3>สินค้า</h3>
  <div class="row">
    @for ($i=0;$i<count($allProduct);$i++)
    <a href="/product/{{$allProduct[$i]->get('id'))}}">
      <div class="col-md-2">
        <p style="text-align:center">
          <img src="/upload/product/{{$allProduct[$i]->get('file')}}" style="max-height:80px">
        </p>
        <p class="text-center" style="text-align:center,z-index:1">{{$allProduct[$i]->get('name')}} ({{ substr($allProduct[$i]->get('price'),0,-5) }}฿)</p>
      </div>
    </a>
    @endfor
  </div>
  <style></style>
</div>
@stop