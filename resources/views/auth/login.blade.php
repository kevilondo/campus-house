@extends('layout.main')

@section('title')
    Campus House | Login
@endsection

@section('body')

<div class="container mt-5">
    <div class="card card-default col-md-6">
        <div class="card-title" style="text-align: center">
            <b> Login </b>
        </div>

        <div class="card-body">
            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="email">E-mail</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
                    
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

            </form>
        </div>
        <div class="card-footer">
            <b>
                If you are new, <a href="/register">create an account</a>
            </b>
        </div>
    </div>
</div>

@endsection
