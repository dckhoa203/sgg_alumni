@extends('layouts.app')

@section('content')
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('accounts/update_password') }}">
                @csrf

                <div class="form-group row">
                    <label for="oldPassword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                    <div class="col-md-6">
                        <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" value="{{ old('oldPassword') }}" required autocomplete="oldPassword">

                        @error('oldPassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Update</button>
                        <br>
                        <br>
                        <a href="{{route('accounts.profile_new')}}" class="btn btn-success">Trở về</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
