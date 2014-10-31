@extends('layout')

@section('body')
<form action="{{URL::current()}}" method="POST" role="form" enctype="multipart/form-data">
    <legend>History: Edit</legend>

    <div class="row">
        <label class="col-md-2 control-label">ID {{$id}}</label>
    </div>

    <div class="form-group row">
        <div class="col-md-5">
            <div class="row">
                <label class="col-md-6 control-label">Create at {{$created_at}}</label>
                <label class="col-md-6 control-label">Update at {{$updated_at}}</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">hid</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="hid" value="{{$hid}}">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">product_id</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="product_id" value="{{$product_id}}">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">quantity</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="quantity" value="{{$quantity}}">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">price</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="price" value="{{$price}}">
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">customer_id</label>
        <input type="text" class="col-md-10 form-control" placeholder="" name="customer_id" value="{{$customer_id}}">
    </div>

    <button type="submit" class="btn btn-primary">Edit</button>

</form>
@stop