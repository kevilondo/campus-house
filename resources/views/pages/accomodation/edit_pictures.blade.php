@extends('layout.main')

@section('title')
    Campus House | Edit Pictures
@endsection

@section('body')

@include('inc.message')

    <div class="container mt-5">       
        <div class="row">
            @foreach ($images as $image)
                    
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card card-hover card-default">

                        <img src="{{$image->path}}" height="360px">

                        <div class="card-footer">
                            <form action="/delete_image/{{$image->id}}" method="POST">
                                @csrf
                                @method('Delete')

                                <button class="btn btn-danger" href="/delete_image/{{$image->id}}" onclick="return confirm('Are you sure?')">
                                    <span> <i class="fas fa-trash"></i> Delete </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach

            <form action="/add_images/{{$accomodation->id}}" method="POST" enctype="multipart/form-data">
                @csrf

                    <input id="picture" type="file" @error('pictures') is-invalid @enderror name="pictures[]" multiple value="{{ old('pictures') }}">

                    @error('pictures')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                <button class="btn btn-primary col-md-4" type="submit">Add Pictures</button>
            </form>

            
        </div>
    </div>
    
@endsection