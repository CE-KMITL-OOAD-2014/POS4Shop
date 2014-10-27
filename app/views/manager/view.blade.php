@extends('layout')

@section('head')
    <title>POS4Shop - Manager::view</title>    
@stop

@section('body')
    <div class="well">
        Name : {{$manager->get('name')}} <br>
        Userame : {{$manager->get('username')}} <br>

        <button type="button" class="btn btn-primary">edit</button>
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
                $.post("{{URL::current()}}",{id:{{$manager->get('id')}} },function(result){
                    window.location.assign("{{URL::to('manager')}}");
                });
            }
            /*
            $.post(".",{id:1},function(result){
                document.location.href="/manager";
            });
             */
        );
    }
    </script>
@stop

