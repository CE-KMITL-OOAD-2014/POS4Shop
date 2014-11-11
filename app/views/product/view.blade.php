@extends('layout')

@section('head')
<title>{{App::make('ceddd\Shop')->getName()}} :: {{$product->get('name')}}</title>    
@stop

@section('body')
@if (Session::get('msg')!=null)
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  {{Session::get('msg')}}
</div>
@endif 
<div class="well">
  <div class="row">
    <div class="col-md-6">
      <img src="/upload/product/{{$product->get('file')}}" class="img-responsive" alt="Image">
    </div>
    <div class="col-md-6">
    <h2>{{$product->get('name')}}</h2>
    <b>บาร์โค้ด</b> : {{$product->get('barcode')}} <br>
    <b>ราคาทุน</b> : {{$product->get('cost')}} <br>
    <b>ราคาขาย</b> : {{$product->get('price')}} <br>
    <b>แก้ไขเมื่อ</b> : {{$product->get('updated_at')}} <br>                
    <a href="{{URL::current().'/edit'}}"><button type="button" class="btn btn-primary">แก้ไข</button></a>
    <button type="button" class="btn btn-danger" onclick="delConfirm()">ลบ</button>
    </div>
  </div>
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
      swal("Deleted!", "Deleted.", "success");
      $.post("{{URL::current()}}",{id:{{$product->get('id')}} },function(result){
        window.location.assign("{{URL::to('product')}}");
      });
    }
    );
  }
</script>
@stop