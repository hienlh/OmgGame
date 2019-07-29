@extends('auth.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-body p-4">
                        <h1>Reset Password</h1>
                        <p class="text-muted">Create your new password</p>
                        <form method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }} mb-3">
                                <span class="input-group-addon">@</span>
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                                       required autofocus>
                            </div>

                            <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }} mb-3">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required
                                       placeholder="Password">
                            </div>

                            <div
                                class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} mb-3">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required placeholder="Confirm Password">
                            </div>

                            <button type="submit" class="btn btn-block btn-warning">Reset Password</button>
                        </form>
                    </div>
                    <div class="card-footer p-4">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-block btn-dark" type="button"
                                        onclick="window.location.href = '{{ route('login') }}';">
                                    <span>Login</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-info" type="button"
                                        onclick="window.location.href = '{{ route('register') }}';">
                                    <span>Register</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
