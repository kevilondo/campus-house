@extends('layout.main')

@section('title')
    Campus House | Browse
@endsection


@section('body')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card-card-default">
                    <div class="card-title">
                        Filter by
                    </div>
                    <div class="card-body">
                        <form action="/browse" method="post">

                            @csrf

                            <div class="form-group">
                                <label for="room_type">Room Type</label>

                                <select name="room_type" class="form-control @error('room_type') is-invalid @enderror" id="room_type">
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
                                <label for="rent">Rent</label>

                                <input type="number" name="rent" id="rent" class="form-control @error('rent') is-invalid @enderror">

                                @error('rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary mt-4">
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                
                @if (isset($accomodations))
                    @if (count($accomodations) > 0)
                        <div class="row">
                            @foreach ($accomodations as $accomodation)
                                
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card card-hover card-default">
                                        <img src="{{$accomodation->thumbnail->path}}" height="360px">
                                        <div class="card-title"><b> {{$accomodation->name}} </b> </div>
                                        <div class="card-body">
                                            <p>{{$accomodation->address}}</p>
                                            <p class="text-success">R{{$accomodation->rent}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <a class="see-more" href="/accomodation/{{$accomodation->id}}">
                                                <small> See more </small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <h6> No result found </h6>
                        </div>
                        
                    @endif
                @else
                    <h5>Filter accomodations based on your preferences</h5>
                @endif
            </div>
        </div>
    </div>
@endsection