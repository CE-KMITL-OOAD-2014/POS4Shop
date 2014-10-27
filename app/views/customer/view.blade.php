@extends('layout')

@section('head')
    <title>POS4Shop - Customer::view</title>    
@stop

@section('body')
    <div class="well">
        Name : {{$customer->get('name')}} <br>
    
        <h2>HISTORY</h2>
        <a href="{{URL::current().'/edit'}}"><button type="button" class="btn btn-primary">edit</button></a>
        <button type="button" class="btn btn-danger" onclick="delConfirm()">del</button>
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
                $.post("{{URL::current()}}",{id:{{$customer->get('id')}} },function(result){
                    window.location.assign("{{URL::to('customer')}}");
                });
            }
        );
    }
    </script>
@stop