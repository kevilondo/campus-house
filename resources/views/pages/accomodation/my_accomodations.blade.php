@extends('layout.main')

@section('title')
    Campus House | My Accomodations
@endsection

@section('body')
   

    <div class="container mt-5"> 
        
        @include('inc.message')

        <h3 class="title">My accomodations</h3>
        @if (count($accomodations) > 0)
            <div class="row">
                @foreach ($accomodations as $accomodation)
                    
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card card-hover card-default">

                            @if (isset($accomodation->thumbnail->path))
                                <img src="{{$accomodation->thumbnail->path}}" height="360px">
                            @else
                                <img src="/assets/no_image.png" alt="no_image" height="360px">
                            @endif

                            <div class="card-title"><b> {{$accomodation->name}} </b> </div>

                            <div class="card-body">
                                <p>{{$accomodation->address}}</p>
                            </div>

                            <div class="card-footer">
                                <form action="/delete/{{$accomodation->id}}" method="POST">
                                    @csrf
                                    @method('Delete')

                                    <a class="btn btn-info" href="/edit/{{$accomodation->id}}">
                                        <span> <i class="fas fa-edit"></i> Edit </span>
                                    </a>

                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        <span> <i class="fas fa-trash"></i>Delete </span>
                                    </button>
                                </form>
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