@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Home</title>
@stop

@section('body')
<div class="well">
  <h3>สินค้าขายดี</h3>
  <div class="row">
    @for ($i=0;$i<count($top);$i++)

    <div class="col-md-3">
      <div class="thumbnail">
        <img src="/upload/product/{{$top[$i]->get('file')}}" alt="{{$top[$i]->get('name')}}" style="max-height:100px">
        <div class="caption">
          <a href="/product/{{$top[$i]->get('id')}}">
            <h3 class="text-center">{{$top[$i]->get('name')}} ({{ substr($top[$i]->get('price'),0,-5) }}฿)</h3>
          </a>
        </div>
      </div>
    </div>

    @endfor
  </div>
  <hr>
  <h3>สินค้า</h3>
  <div class="row">
    @for ($i=0;$i<count($allProduct);$i++)

    <div class="col-md-3">
      <div class="thumbnail">
        <img src="/upload/product/{{$allProduct[$i]->get('file')}}" alt="{{$allProduct[$i]->get('name')}}" style="max-height:100px">
        <div class="caption">
          <a href="/product/{{$allProduct[$i]->get('id')}}">
            <h4 class="text-center">{{$allProduct[$i]->get('name')}} ({{ substr($allProduct[$i]->get('price'),0,-5) }}฿)</h4>
          </a>
        </div>
      </div>
    </div>

    @endfor
  </div>
  <style></style>
</div>
@stop