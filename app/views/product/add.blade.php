@extends('layout')
@section('head')
    <title>{{App::make('ceddd\Shop')->getName()}} :: เพิ่มสิน้คาใหม่</title>
@stop

@section('body')
    <form action="{{url('/product/add')}}" method="POST" role="form" enctype="multipart/form-data">
        <legend>Product : New</legend>

        @if (Session::get('msg')!=null)
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('msg')}}
            </div>
        @endif 

        <div class="form-group row">
            <label for="inputFile" class="col-md-2 control-label">File</label>
            <div class="col-md-10">
                <input readonly="" class="form-control floating-label" placeholder="Browse..." type="text">
                <input name="file" multiple="" type="file">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 control-label">บาร์โค้ด</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="barcode" required>
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">สินค้า</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="name" required>
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">รายละเอียด</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="detail">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">ราคาทุน</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="cost" required>
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">ราคาขาย</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="price" required>
        </div>
        <input type="submit" class="btn btn-primary" value="เพิ่ม">
    </form>
@stop