@extends('layout')
@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} - Product::add</title>
@stop

@section('body')
@if (Session::get('msg')!=null)
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {{Session::get('msg')}}
</div>
@endif 
<div class="well">
  <h2>Point Of Sale</h2>

  <!-- <form action="{{url('/manager/shop/product')}}" method="POST" role="form"> -->
  <div class="form-group">
    <div class="input-group">
      <input class="form-control" type="text" name="search" id="search" placeholder="บาร์โค้ด หรือชื่อสินค้า">
      <span class="input-group-btn">
        <input type="submit" class="btn btn-primary" value="ค้นหา" onclick="search()" data-toggle="modal" data-target="#myModal">
      </span>
    </div>
  </div>
  <!-- </form> -->
  <div class="form-group">
    <div class="input-group">
      <input class="form-control" type="text" name="searchC" id="searchCustomer" placeholder="ลูกค้า" value="{{ isset($customer) ? $customer: '' }}">
      <span class="input-group-btn">
        <input type="submit" class="btn btn-primary" value="ค้นหา" onclick="searchCustomer()" data-toggle="modal" data-target="#customerModal">
      </span>
    </div>
  </div>
  <table class="table table-striped table-hover" id="item">
    <thead>
      <tr>
        <th class="text-center">บาร์โค้ด</th>
        <th class="text-center">รายการ</th>
        <th class="text-center">จำนวน</th>
        <th class="text-center">ราคาต่อชิ้น</th>
        <th class="text-center">มูลค่า</th>
        <th class="text-center">แก้ไข</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pos as $soldItem)
      <tr>
        <td class="text-center">{{$soldItem->get('item')->get('barcode')}}</td>
        <td class="text-center">{{$soldItem->get('item')->get('name')}}</td>
        <td class="text-center">{{$soldItem->get('quantity')}}</td>
        <td class="text-center">{{$soldItem->get('price')}}</td>
        <td class="text-center">{{$soldItem->get('quantity')*$soldItem->get('price')}}</td>
        <td class="text-center"><button class="btn btn-danger" onclick="del('{{$soldItem->get('item')->get('barcode')}}')">Delete</button></td>
      </tr>
      @endforeach

      <tr class="info">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center">รวม</td>
        <td class="text-center">{{$allPrice}}</td>
      </tr>
    </tbody>
  </table>
  <div class="row">
    <div class="col-md-9">
      <button type="submit" class="btn btn-danger" onclick="delConfirm(0)">ล้างรายการ</button>
    </div>
    <div class="col-md-3">
      <form action="/manager/shop" method="POST" role="form" class="form-horizontal">
        <fieldset>  
          <button type="submit" class="btn btn-success pull-right">ทำรายการ</button>
        </fieldset>            
      </form>
    </div>
  </div>
</div>

<!-- Modal Product -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">ค้นหา</h4>
      </div>
      <div class="modal-body product">
        กำลังโหลด
      </div>
    </div>
  </div>
</div>

<!-- Modal Customer -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="customerModalLabel">ค้นหาลูกค้า</h4>
      </div>
      <div class="modal-body customer">
        กำลังโหลด
      </div>
    </div>
  </div>
</div>
@stop

@section('js')
<script>
  function del(barcode){
    $.post("{{URL::current().'/product/'}}"+barcode+"/del",{barcode:barcode},function(result){
      location.reload(true);
    });
  }
</script>
<script>
  function delConfirm(barcode){
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
      swal("Deleted!", "Deleted.", "success");
      del(barcode);
    }
    );
  }
</script>
<script>
  function search(){
    var name=$( "#search" ).val();
    $.post("{{url('/manager/shop/product')}}",{search:name},function(result){
      $( ".product" ).html(result);
    });   
  }
  function searchCustomer(){
    var name=$( "#searchCustomer" ).val();
    $.post("{{url('/manager/shop/customer')}}",{search:name},function(result){
      $( ".customer" ).html(result);
    });
  }
</script>
@stop
