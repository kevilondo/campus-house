@extends('layout.main')

@section('title')
    Campus House | Register
@endsection


@section('body')

<div class="container mt-5">
    <div class="card card-default col-md-6">
        <div class="card-title" style="text-align: center">
            <b> Sign Up </b>
        </div>

        <div class="card-body">
            <form action="{{ route('register') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="first_name">First Name</label>

                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>

                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
                    <label for="phone_number">Phone Number</label>

                    <input id="phone_number" type="phone" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                    @error('phone_number')
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

                <div class="form-group">
                    <label for="password-confirmation">Password Confirmation</label>

                    <input id="password-confirmation" type="password" name="password_confirmation" class="form-control" required>

                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <b>
                If you already have an account, <a href="/login">Sign In</a>
            </b>
        </div>
    </div>
</div>

@endsection
