@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - จัดการ</title>
@stop

@section('body')
<div class="well text-center">
  <!-- <a href="manager/shop"><button type="button" class="btn btn-lg btn-primary">คิดเงิน <span class="glyphicon glyphicon-shopping-cart"></span></button></a> -->
  <a href="manager/list"><button type="button" class="btn btn-lg btn-primary">รายชื่อผู้จัดการ <span class="glyphicon glyphicon-user"></span></button></a>

  <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#namechg">เปลี่ยนชื่อร้าน <span class="glyphicon glyphicon-registration-mark"></span></button>

  <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#pwdchg">เปลี่ยนรหัสผ่าน <span class="mdi-communication-vpn-key"></span></button>

<!-- Shop name -->
<div class="modal fade" id="namechg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" role="form" action="manager/name" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">เปลี่ยนชื่อร้าน</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อร้าน</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="name" value="{{App::make('ceddd\Shop')->getName()}}">
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

<!-- PWD Change -->
  <div class="modal fade" id="pwdchg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-horizontal" role="form" action="manager/pwd" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">เปลี่ยนรหัสผ่าน</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">รหัสผ่านเดิม</label>
              <div class="col-sm-10">
                <input type="password" required class="form-control" name="oldpwd">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">รหัสผ่านใหม่</label>
              <div class="col-sm-10">
                <input type="password" required class="form-control" name="newpwd">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">ยืนยันรหัสผ่าน</label>
              <div class="col-sm-10">
                <input type="password" required class="form-control" name="conpwd">
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