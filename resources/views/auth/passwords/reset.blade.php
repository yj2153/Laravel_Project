@extends('layouts/layout')

@section('title', 'Login')

@section('stylesheet')
<link rel="stylesheet" href="{{asset('/css/join/signUp.css ')}}"/>
@endsection

@section('content')
<div id="lead">
    <h1>{{ __('Reset Password') }}</h1>
</div> 

<div id="signDiv" > 
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <p class="error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                </td>
                                <td>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                        <p class="error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                </td>
                                <td>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <div class="submitBtn">
            <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
@endsection
