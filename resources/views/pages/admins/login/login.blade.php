@extends('layouts.admin')
@section('content')
<div class="container box">
    @if ($message = Session::get('error'))
    <div class="alert alert-dander alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{$message}}</strong>
    </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{route('posts.checklogin')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="email">Enter your Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password">Enter your password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Login</button>
                <a href="{{route('posts.register')}}" class="btn btn-warning">Register</a>
            </div>
        </form>
    </div>
    
@endsection
