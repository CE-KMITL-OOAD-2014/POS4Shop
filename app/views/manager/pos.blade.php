@extends('layout')
@section('head')
    <title>POS4Shop - Product::add</title>
@stop

@section('body')

    <form action="{{url('/manager/shop/product')}}" method="POST" role="form">
        <input class="form-control col-lg-8" placeholder="Search" type="text" name="search">
    </form>
    <hr>

    <form action="{{url('/product/add')}}" method="POST" role="form" enctype="multipart/form-data">
        <legend>Point of sale</legend>

        @if (Session::get('msg')!=null)
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('msg')}}
            </div>
        @endif 

        <div class="form-group row">
            <label class="col-md-2 control-label">Name</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="search">
        </div>
        
        <button type="submit" class="btn btn-primary">New</button>

    </form>

    <div class="row">
        @foreach ($pos as $soldItem)      
            <div class="col-md-3">
                {{$soldItem->get('item')->get('barcode')}}
            </div>
            <div class="col-md-3">
                {{$soldItem->get('item')->get('name')}}
            </div>
            <div class="col-md-2">
                {{$soldItem->get('quantity')}} ชิ้น
            </div>
            <div class="col-md-2">
                {{$soldItem->get('price')}} บาท
            </div>
            <div class="col-md-2">
                {{$soldItem->get('quantity')*$soldItem->get('price')}} บาท
            </div>
        @endforeach
    </div>
@stop