@extends('layouts.app')

@section('content')
    <!-- Preloader -->
    <section id="wrapper" class="login-register">
            <div class="login-box">
                <div class="white-box">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{$message}}</p>
                        <p class="mb-0"></p>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('MSSV') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div class="forgot">
                                        <a class="btn btn-link" href="{{route('forget_passwords.index')}}">Quên mật khẩu</a>
                                        @if (Route::has('password.request'))
                                            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a> --}}
                                        @endif
                                    </div>
                                    {{-- <a href="{{route('forget_passwords.index')}}">Quên mật khẩu</a> --}}
                                </div>
                            </div>
                        </div>

                                <div class="form-group text-center m-t-20">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <p>
                                    
                                        @guest
                                            @if (Route::has('register'))
                                                {{-- <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Sign Up</b></a> --}}
                                            @endif
                                            @else
                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->name }} <span class="caret"></span>
                                                    </a>
                    
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>
                    
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                                        @endguest        
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection
