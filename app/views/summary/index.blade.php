@extends('layout')
@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - สรุปยอดการขาย</title>
@stop
@section('body')

<div class="well">
    <form action="/summary" method="POST" role="form">
      
        <div class="form-group">
          <div class="col-xs-12">
            <div class="col-md-3">
              <div class="col-md-3">
                วันที่
              </div>
              <div class="col-md-3">
                <input type="number" required class="form-control" name="day" min=1 max=31 value="{{date('d')}}">
              </div>
            
              <div class="col-md-3">
                <input type="number" required class="form-control" name="month" min=1 max=12 value="{{date('m')}}">
              </div>
            
              <div class="col-md-3">
                <input type="number" required class="form-control" name="year" min=1970 max={{date('Y')}} value="{{date('Y')}}">
              </div>
            </div>
          </div>
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