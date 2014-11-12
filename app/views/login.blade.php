@extends('layout')
@section('head')
    <title>{{App::make('ceddd\Shop')->getName()}} - Manager::Login</title>
@stop

@section('body')
<div class="well">    
    <form action="{{url('/login')}}" method="POST" role="form">
        <legend>Login</legend>

        <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control" name="username">
        </div>   

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@stop