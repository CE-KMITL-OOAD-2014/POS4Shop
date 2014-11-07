@extends('layout')

@section('head')
    <title>POS4Shop - {{$product->get('name')}}</title>    
@stop

@section('body')
    @if (Session::get('msg')!=null)
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('msg')}}
        </div>
    @endif 
    <div class="well">
        Barcode : {{$product->get('barcode')}} <br>
        Name : {{$product->get('name')}} <br>
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