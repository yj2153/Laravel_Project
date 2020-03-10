@extends('layouts/layout')

@section('title', 'Login')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/join/signUp.css ')}}"/>
@endsection

@section('content')
<div id="lead">
    <h1>{{ __('Reset Password') }}</h1>
</div> 
<div id="signDiv" style="height:100px;"> 
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div id="signTblDiv">
            <table style="width:100%; height:100%">
                <tr>
                    <td>
                        <table id="signTbl" >
                            <tr>
                                <td>
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                </td>
                                <td>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <p class="error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="submitBtn" style="text-align:center;">
            <button type="submit" class="btn btn-primary">
            {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
</div>
@endsection
