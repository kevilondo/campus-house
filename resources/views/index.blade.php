@extends('layout.main')

@section('title')
    Campus House | Welcome
@endsection


@section('body')

    <div class="welcome">
        <h1 class="welcome-title">Welcome to Campus House</h1>

        <h2 style="color: white;">Find accomodations easier and faster</h2>
        <img src="/assets/welcome.jpeg" class="welcome-bg-img" alt="Welcome to Campus House">
    </div>
    

    <div class="container mt-5">       

        <h3 class="title">Latest accomodations</h3> <br>
        <div class="row">
            @foreach ($accomodations as $accomodation)
                
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card card-hover card-default">
                        <img src="{{$accomodation->thumbnail->path}}" height="360px">
                        <div class="card-title"><b> {{$accomodation->name}} </b> </div>
                        <div class="card-body">
                            <p>{{$accomodation->address}}</p>
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
    </div>
    
@endsection