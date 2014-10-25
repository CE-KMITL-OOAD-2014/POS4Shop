@extends('layout')

@section('body')
    <form action="{{url('/product/add')}}" method="POST" role="form" enctype="multipart/form-data">
        <legend>Product : New</legend>
        
        @foreach($errors->all() as $message)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <li>{{ $message }}</li>
            </div>
        @endforeach

        @if (Session::get('msg')!=null)
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('msg')}}
            </div>
        @endif     

        <div class="form-group row">
            <label for="inputFile" class="col-md-2 control-label">File</label>
            <div class="col-md-10">
                <input readonly="" class="form-control floating-label" placeholder="Browse..." type="text">
                <input name="img" multiple="" type="file">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2 control-label">Barcode</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="barcode">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Name</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="name">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Detail</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="detail">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Cost</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="cost">
        </div>
        
        <div class="form-group row">
            <label class="col-md-2 control-label">Price</label>
            <input type="text" class="col-md-10 form-control" placeholder="" name="price">
        </div>

        <button type="submit" class="btn btn-primary">New</button>

    </form>
@stop