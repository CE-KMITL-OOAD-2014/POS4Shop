@extends('layout')
@section('head')
    <title>{{App::make('ceddd\Shop')->getName()}} - แก้ไขข้อมูลลูกค้า {{$name}}</title>
@stop

@section('body')
    <form action="{{URL::current()}}" method="POST" role="form" enctype="multipart/form-data">
        <legend>แก้ไขข้อมูลลูกค้า</legend>
        
        <div class="row">
            <label class="col-md-2 control-label">ID {{$id}}</label>
        </div>

        <div class="form-group row">
            <label class="col-md-6 control-label">สร้างเมื่อ {{$created_at}}</label>
            <label class="col-md-6 control-label">แก้ไขเมื่อ {{$updated_at}}</label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">ชื่อ</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="name" value="{{$name}}" required>
        </div>

        <button type="submit" class="btn btn-primary">แก้ไข</button>

    </form>
@stop