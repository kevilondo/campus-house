@extends('layout.main')

@section('title')
    Campus House | Edit an accomodation
@endsection

@section('body')

<div class="container mt-5">

    @include('inc.message')

    <div class="card card-default col-md-6">
        <div class="card-title" style="text-align: center">
            <b> Edit an accomodation </b>
        </div>

        <div class="card-body">
            <form action="/edit/{{$accomodation->id}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Accomodation name</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $accomodation->name }}"  autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>

                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $accomodation->address }}"  autocomplete="address" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rent">Rent (in Rand)</label>

                    <input id="rent" type="number" class="form-control @error('rent') is-invalid @enderror" name="rent" value="{{ $accomodation->rent }}"  autocomplete="rent" autofocus>

                    @error('rent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <a class="btn btn-info" href="/edit/pictures/{{$accomodation->id}}" style="color:white">Edit pictures</a>

                    @error('picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="room_type">Room Type</label>

                    <select name="room_type" class="form-control @error('room_type') is-invalid @enderror">
                        <option value="">Select a room type</option>
                        <option value="Single Room" {{$accomodation->room_type == 'Single Room' ? 'selected' : ''}}>Single room</option>
                        <option value="Double Room" {{$accomodation->room_type == 'Double Room' ? 'selected' : ''}}>Double room</option>
                    </select>

                    @error('room_type')
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
