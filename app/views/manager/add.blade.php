@extends('layout')
@section('head')
    <title>POS4Shop - Manager::add</title>
@stop

@section('body')
    <form action="{{url('/manager/add')}}" method="POST" role="form">
        <legend>Manager : New</legend>
        
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" id="" placeholder="Jonh Doe" name="name">
        </div>   

        <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" id="" placeholder="jonh" name="username">
        </div>   

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="" placeholder="doe password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop