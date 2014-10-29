@extends('layout')
@section('head')
<title>POS4Shop - Test</title>
@stop

@section('body')
<form action="{{url('/test')}}" method="POST" role="form" enctype="multipart/form-data">
    <legend>History New</legend>

    <div class="form-group row">
        <label class="col-md-2 control-label">hid</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="hid">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">product_id</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="product_id">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">quantity</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="quantity">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">price</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="price">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">customer_id</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="customer_id">
    </div>

    <button type="submit" class="btn btn-primary">New</button>

</form>
@stop



