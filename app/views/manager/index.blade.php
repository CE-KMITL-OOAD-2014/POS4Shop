@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Dashboard</title>
@stop

@section('body')
<div class="well">
  <a href="{{url('manager/shop')}}"><button type="button" class="btn btn-lg btn-primary">P.O.S.</button></a>
  <a href="{{url('product')}}"><button type="button" class="btn btn-lg btn-primary">จัดการสินค้า</button></a>
  <a href="{{url('customer')}}"><button type="button" class="btn btn-lg btn-primary">จัดการลูกค้า</button></a>
  <a href="{{url('manager/list')}}"><button type="button" class="btn btn-lg btn-primary">จัดการพนักงาน</button></a>

  
  <a href="{{url('')}}"><button type="button" class="btn btn-lg btn-primary">เปลี่ยนชื่อร้าน</button></a>


  <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">เปลี่ยนรหัสผ่าน</button>


  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-horizontal" role="form" action="{{url('manager/pwd')}}" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">เปลี่ยนรหัสผ่าน</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">รหัสผ่านเดิม</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="oldpwd">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">รหัสผ่านใหม่</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="newpwd">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">ยืนยันรหัสผ่าน</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="conpwd">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="ยืนยัน">
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop