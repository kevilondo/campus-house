@extends('layout.main')

@section('title')
    Campus House | My Accomodations
@endsection

@section('body')
   

    <div class="container mt-5">       

        <h3 class="title">My accomodations</h3>
        @if (count($accomodations) > 0)
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
                                <a class="edit" href="/edit/{{$accomodation->id}}">
                                    <small> Edit </small>
                                </a>
                                <a class="delete" href="/accomodation/{{$accomodation->id}}">
                                    <small> Delete </small>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <p>You have not posted an accomodation yet</p>
            </div>
        @endif
    </div>
    
@endsection