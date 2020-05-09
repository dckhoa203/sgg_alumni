@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('forget_passwords.update')}}">
                        @csrf
                        @if($message = Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                <p>{{$message}}</p>
                                <p class="mb-0"></p>
                            </div>
                        @endif
                        @if($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                <p>{{$message}}</p>
                                <p class="mb-0"></p>
                            </div>
                        @endif
                        <div class="form-group">
                          <label for="">Enter your email:</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
