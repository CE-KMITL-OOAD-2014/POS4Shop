@extends('layout')

@section('body')
    <form action="{{url('/customer/add')}}" method="POST" role="form">
        <legend>Customer : New</legend>

        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" id="" placeholder="Input field" name="name">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop