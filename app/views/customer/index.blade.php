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
  <h3>รายชื่อลูกค้า<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#namechg">เพิ่ม</button></h3>
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>ID</th>
        <th>ชื่อ</th>
        <th>สร้างเมื่อ</th>
        <th>แก้ไขเมื่อ</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($allCustomer as $val)
        <tr>
          <td>{{$val->get('id')}}</td>
          <td><a href="/customer/{{$val->get('id')}}">{{$val->get('name')}}</a></td>
          <td>{{$val->get('created_at')}}</td>
          <td>{{$val->get('updated_at')}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<!-- Add -->
<div class="modal fade" id="namechg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{url('/customer/add')}}" method="POST" role="form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">ลูกค้าใหม่</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">ชื่อ</label>
            <input type="text" class="form-control" id="" placeholder="Input field" name="name" required>
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