@extends('layout')
@section('head')
    <title>POS4Shop - Manager::Login</title>
@stop

@section('body')
    <form action="{{url('/login')}}" method="POST" role="form">
        <legend>Login</legend>

        <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" id="" placeholder="jonh" name="username">
        </div>   

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="" placeholder="doe password" name="password">
        </div>

        <div class="form-group">
            <label for="">Remember me</label>
            <input type="checkbox" class="form-control" id="" placeholder="doe password" name="remember">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop