@extends('layout')

@section('body')
    <form action="{{url('/product/'.$id.'/edit')}}" method="POST" role="form" enctype="multipart/form-data">
        <legend>Product : Edit</legend>
        
        @foreach($errors->all() as $message)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <li>{{ $message }}</li>
            </div>
        @endforeach

        <div class="form-group row">
            <label class="col-md-2 control-label">ID {{$id}}</label>
            <label class="col-md-5 control-label">Create at {{$created_at}}</label>
            <label class="col-md-5 control-label">Update at {{$updated_at}}</label>
        </div>

        <div class="form-group row">
            <label for="inputFile" class="col-md-2 control-label">File</label>
            <div class="col-md-10">
                <input readonly="" class="form-control floating-label" placeholder="Browse..." type="text">
                <input name="img" multiple="" type="file">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 control-label">Barcode</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="barcode" value="{{$barcode}}">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Name</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="name" value="{{$name}}">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Detail</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="detail" value="{{$detail}}">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Cost</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="cost" value="{{$cost}}">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Price</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="price" value="{{$price}}">
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>

    </form>
@stop