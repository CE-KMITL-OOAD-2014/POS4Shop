@extends('layout')

@section('body')
    <form action="{{URL::current()}}" method="POST" role="form" enctype="multipart/form-data">
        <legend>Product : Edit</legend>
        
        <div class="row">
            <label class="col-md-2 control-label">ID {{$id}}</label>
        </div>

        <div class="form-group row">
            <label class="col-md-6 control-label">Create at {{$created_at}}</label>
            <label class="col-md-6 control-label">Update at {{$updated_at}}</label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Name</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="name" value="{{$name}}">
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>

    </form>
@stop