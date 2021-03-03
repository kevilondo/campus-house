@extends('layout.main')

@section('title')
    Campus House | Profile
@endsection

@section('body')

<div class="container mt-5">

    @include('inc.message')

    <div class="card card-default col-md-6">
        <div class="card-title" style="text-align: center">
            <b> Edit Profile </b>
        </div>

        <div class="card-body">
            <form action="/update_profile" method="post">
                @csrf

                <div class="form-group">
                    <label for="first_name">First Name</label>

                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>

                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->surname }}" required autocomplete="surname" autofocus>

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>

                    <input id="phone_number" type="phone" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="0{{ $user->phone_number }}" required autocomplete="phone_number" autofocus>

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Change Password</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>

                    <input id="password_confirmation" type="password" class="form-control @error('password-confirmation') is-invalid @enderror" name="password_confirmation">

                    @error('password-confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>
        </div>
        
    </div>
</div>

@endsection
