@extends('layouts/layout')

@section('title', 'Login')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/main/login.css ')}}"/>
@endsection

@section('content')
<div id='loginDiv' class="card">
    <div id="lead" class="card-header">
        <h1>{{ __('Login') }}</h1>
    </div>
    <form method="POST" action="{{ route('login') }}">
        <div id="loginTblDiv"  class="card-body">
            @csrf
            <table style="width:100%; height:100%;">
               <tr>
                    <td>
                        <table id="loginTbl">
                            <tr>
                                <td>
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                </td> 
                                <td>
                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    </div>
                                </td>   
                            </tr>
                            <tr>
                                <td>
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                </td>
                                <td>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                    </div>
                                </td>
                            </tr>    
                            <tr>
                                <td colspan='2'>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                    @error('email')
                                        <p class="error" role="alert">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                    @error('password')
                                        <p class="error" role="alert">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                    @error('loginError')
                                        <p class="error">{!! $message !!}</p>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width:90%; margin:0 auto;">
            <div>
                <button type="button" onclick="location.href='{{route('register')}}'">
                    {{ __('Register') }}
                </button>
                <button type="submit" style="float:right;">
                    {{ __('Login') }}
                </button>
            </div>
            @if (Route::has('password.request'))
            <div style="margin-top:15px; text-align:center;">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
            @endif
        </div>
    </form>
</div>
@endsection