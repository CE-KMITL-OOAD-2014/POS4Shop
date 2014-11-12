@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} :: สินค้า</title>
@stop

@section('body')
@if (Session::get('msg')!=null)
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {{Session::get('msg')}}
</div>
@endif 
<div class="well">
  <h2>รายการสินค้า <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#namechg">เพิ่มสินค้าใหม่</button></h2>
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <!-- <th>Product ID</th> -->
        <th>บาร์โค้ด</th>
        <th>สินค้า</th>
        <th>ราคาทุน</th>
        <th>ราคาขาย</th>
        <th class="text-center">แก้ไขเมื่อ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(count($allProduct)>0)
      foreach ($allProduct as $val) {
        ?>
        <tr>
          <!-- <td>{{$val->get('id')}}</td> -->
          <td>{{$val->get('barcode')}}</td>
          <td><a href="{{URL::current().'/'.$val->get('id')}}">{{$val->get('name')}}</a></td>
          <td>{{$val->get('cost')}}</td>
          <td>{{$val->get('price')}}</td>
          <td class="text-center">{{$val->get('updated_at')}}</td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>
<!-- Add -->
<div class="modal fade" id="namechg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{url('/product/add')}}" method="POST" role="form" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">สินค้าใหม่</h4>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label for="inputFile" class="col-md-2 control-label">File</label>
            <div class="col-md-10">
              <input readonly="" class="form-control floating-label" placeholder="Browse..." type="text">
              <input name="file" multiple="" type="file" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2 control-label">บาร์โค้ด</label>
            <div class="col-md-10">
              <input type="text" class="form-control" placeholder="" name="barcode" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2 control-label">สินค้า</label>
            <div class="col-md-10">
              <input type="text" class="form-control" placeholder="" name="name" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2 control-label">รายละเอียด</label>
            <div class="col-md-10">
              <input type="text" class="form-control" placeholder="" name="detail">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2 control-label">ราคาทุน</label>
            <div class="col-md-10">
              <input type="text" class="form-control" placeholder="" name="cost" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2 control-label">ราคาขาย</label>
            <div class="col-md-10">
              <input type="text" class="form-control" placeholder="" name="price" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="เพิ่ม">
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('js')
@stop