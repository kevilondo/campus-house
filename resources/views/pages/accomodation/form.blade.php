@extends('layout.main')

@section('title')
    Campus House | Add an accomodation
@endsection

@section('body')

<div class="container mt-5">

    @include('inc.message')

    <div class="card card-default col-md-6">
        <div class="card-title" style="text-align: center">
            <b> Add an accomodation </b>
        </div>

        <div class="card-body">
            <form action="/add_accomodation" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Accomodation name</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>

                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"  autocomplete="address" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rent">Rent (in Rand)</label>

                    <input id="rent" type="number" class="form-control @error('rent') is-invalid @enderror" name="rent" value="{{ old('rent') }}"  autocomplete="rent" autofocus>

                    @error('rent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="room_type">Room Type</label>

                    <select name="room_type" class="form-control @error('room_type') is-invalid @enderror">
                        <option value="">Select a room type</option>
                        <option value="Single Room">Single room</option>
                        <option value="Double Room">Double room</option>
                    </select>

                    @error('room_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="picture">Upload pictures</label>

                    <input id="picture" type="file" class="form-control @error('pictures') is-invalid @enderror" name="pictures[]" multiple value="{{ old('pictures') }}"  autocomplete="pictures" autofocus>

                    @error('pictures')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>

            </form>
        </div>
        
    </div>
</div>

@endsection
