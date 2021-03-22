@extends('layout.main')

@section('title')
    Campus House | Pay Now
@endsection

@section('body')
    <div class="container mt-5">

        @include('inc.message')

        <div class="card card-default">
            <div class="container mt-5 mb-2">

                <h3>Accomodation Fee</h3>
                
                <p>Price: <b>R150</b> </p>

                <div class="alert alert-success">The transaction was completed successfully</div>

            </div>
        </div>
    </div>
@endsection