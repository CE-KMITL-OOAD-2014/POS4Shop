@extends('layout')
@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - สรุปยอดการขาย</title>
@stop
@section('body')
<div class="well">
  <h2>ระบุวันที่</h2>
  <form action="/summary" method="POST" role="form">
    <div class="form-group">
      <input type="date" name="date" max="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" required>
    </div>

    <div class="form-group">
      <div class="col-xs-12">
        <div class="col-md-6">
          <div class="col-md-4">
            <div class="radio radio-primary">
              <label>
                <input name="summary" value="30" checked="" type="radio">
                <span class="circle"></span><span class="check"></span>
                รายวัน
              </label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="radio radio-primary">
              <label>
                <input name="summary" value="12" type="radio">
                <span class="circle"></span><span class="check"></span>
                รายเดือน
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <input type="submit" class="btn btn-success" value="ดู">
    
  </form>
</div>
@stop