@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Product</title>
@stop

@section('body')
@if (Session::get('msg')!=null)
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {{Session::get('msg')}}
</div>
@endif
<div class="well">
  <h3>รายชื่อผู้จัดการ <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#namechg">เพิ่ม</button></h3>
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Create At</th>
        <th>Update At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($allManager as $val) {
        ?>
        <tr>
          <td>{{$val->get('id')}}</td>
          <td><a href="{{url('manager/'.$val->get('id'))}}">{{$val->get('name')}}</a></td>
          <td>{{$val->get('username')}}</td>
          <td>{{$val->get('created_at')}}</td>
          <td>{{$val->get('updated_at')}}</td>
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
      <form action="/manager/add" method="POST" role="form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">ผู้จัดการใหม่</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">ชื่อ</label>
              <input type="text" class="form-control" id="" placeholder="Jonh Doe" name="name" required>
            </div>   

            <div class="form-group">
              <label for="">Username</label>
              <input type="text" class="form-control" id="" placeholder="jonh" name="username" required>
            </div>   

            <div class="form-group">
              <label for="">รหัสผ่าน</label>
              <input type="password" class="form-control" id="" placeholder="doe password" name="password" required>
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