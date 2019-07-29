@extends('auth.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <div class="card-body p-4">
                        <h1>Reset Password</h1>
                        <p class="text-muted">What is your email?</p>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div class="input-group mb-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Email" name="email"
                                       value="{{ old('email') }}"
                                       required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-block btn-warning">
                                Send Password Reset Link
                            </button>
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
