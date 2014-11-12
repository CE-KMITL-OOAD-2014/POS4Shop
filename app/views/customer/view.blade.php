@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Customer::view</title>    
@stop

@section('body')
<div class="well">
  <div class="row">
    <div class="col-md-6">
      <h3>ลูกค้า : {{$customer->get('name')}}</h3>      
    </div>
    <div class="col-md-6">
      <a href="{{URL::current().'/edit'}}"><button type="button" class="btn btn-primary pull-right">edit</button></a>
      <button type="button" class="btn btn-danger pull-right" onclick="delConfirm()">del</button>      
    </div>
  </div>
  <h4>ประวัติการซื้อสินค้า</h4>
  <hr>
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>เวลาที่ซื้อ</th>
        <th>รายการ</th>
        <th>จำนวน</th>
        <th>ราคาต่อชิ้น</th>
      </tr>
    </thead>
    <tbody>
    @if (count($history)>0)
    
    @foreach ($history as $his)
      <tr>
        <td>
          {{$his->get('created_at')}}
        </td>
        <td>
          @foreach ($his->get('item') as $item)
            {{$item->get('item')->get('name')}} <br>
          @endforeach
        </td>
        <td>
          @foreach ($his->get('item') as $item)
            {{$item->get('quantity')}} <br>
          @endforeach
        </td>
        <td>
          @foreach ($his->get('item') as $item)
            {{$item->get('price')}} <br>
          @endforeach
        </td>
      </tr>
    @endforeach
    @endif
    </tbody>
  </table>
</div>
@stop

@section('js')
<script type="text/javascript">
  function delConfirm(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      swal("Deleted!", "Deleted.", "success. Wait for refresh in a few second");
      $.post("{{URL::current()}}",{id:{{$customer->get('id')}} },function(result){
        window.location.assign("{{URL::to('customer')}}");
      });
    }
    );
  }
</script>
@stop