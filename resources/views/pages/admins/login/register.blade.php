@extends('layouts.admin')
@section('content')
<div class="container box">
        <h3 align="center">Register Form</h3>
        <br>
        @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
            
        @endif
    <form action="{{route('posts.register_store')}}" method="post">
            @csrf
            <div class="form-group">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group" align="center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="form-group" align="left">
            <a href="{{route('posts.login')}}" class="text-primary">Đăng nhập</a>
            </div>
            
        </form>
    </div>
    
@endsection