@extends('layout.main')

@section('title')
    Campus House | {{$accomodation->name}}
@endsection

@section('body')

    <div class="container mt-5">       
        <div class="row">
            <div class="col-md-7">
                <h4>{{$accomodation->name}}</h4>
                <img src="{{$accomodation->thumbnail->path}}" width="100%">
                <div class="container mt-3">
                    <div class="card card-default">
                        <div class="card-title">
                            <b>Other pictures</b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($accomodation->image as $image)
                                    @if ($image->path != $accomodation->thumbnail->path)
                                        <div class="col-md-3">
                                            <div class="card card-default">
                                                <a href="{{$image->path}}">
                                                    <img src="{{$image->path}}" width="100%" height="160px">
                                                </a>
                                            </div>
                                            
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>                     
                    </div>
                    <div class="mt-4" >
                        <p> <b>Address:</b> <h6 id="address"> {{$accomodation->address}} </h6> </p>
                        <b>Rent: <i class="text-danger">R{{$accomodation->rent}}</i></b>
                        <p><b>Room type: <i class="text-danger">{{$accomodation->room_type}}</i> </b></p>
                    </div>

                    <div class="card card-default">
                        <div class="card-title container"> <b>Landloard contact details</b> </div>
                        <div class="card-body">
                            <p>E-mail: {{$accomodation->user->email}}</p>
                            <p>Phone number: {{$accomodation->user->phone_number}}</p>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="col-md-5 mt-4">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="/js/map.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPpd0mCpEYxt3GDnOcFZtmY4IeaqUHPts&callback=initMap"
    async defer></script>
    
@endsection