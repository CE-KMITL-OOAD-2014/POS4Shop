@extends('layout')
@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} :: Product::edit</title>
@stop

@section('body')
<div class="well">

  <form action="{{URL::current()}}" method="POST" role="form" enctype="multipart/form-data">
    <legend>แก้ไขข้อมูลสินค้า</legend>

    <div class="form-group row">
      <label for="inputFile" class="col-md-2 control-label">รูปสินค้า</label>

      <div class="col-md-5">
        <img src="{{asset('upload/product/'.$file)}}" class="img-responsive" alt="Image">
      </div>
      <div class="col-md-5">
        <input readonly="" class="form-control floating-label" placeholder="Browse..." type="text">
        <input name="file" multiple="" type="file">
      </div>
    </div>



    <div class="form-group">
      <label class="col-md-2 control-label">บาร์โค้ด</label>
      <div class="col-md-10">
        <input type="text" class="form-control" placeholder="" name="barcode" value="{{$barcode}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label">สินค้า</label>
      <div class="col-md-10">
        <input type="text" class="form-control" placeholder="" name="name" value="{{$name}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label">รายละเอยีด</label>
      <div class="col-md-10">
        <input type="text" class="form-control" placeholder="" name="detail" value="{{$detail}}">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label">ราคาทุน</label>
      <div class="col-md-10">
        <input type="text" class="form-control" placeholder="" name="cost" value="{{$cost}}" required>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2 control-label">ราคาทุน</label>
      <div class="col-md-10">
        <input type="text" class="form-control" placeholder="" name="price" value="{{$price}}" required>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">แก้ไข</button>

  </form>
</div>
@stop