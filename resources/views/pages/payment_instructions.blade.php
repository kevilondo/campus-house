@extends('layout.main')

@section('title')
    Campus House | Payment Instructions
@endsection

@section('body')
    <div class="container mt-5">

        @include('inc.message')

        <div class="card card-default">
            <div class="container mt-5 mb-2">
                <h3>A monthly fee is required to post accomodations</h3> <br>

                <p>You can either make a direct deposit to our account or send a EFT by using this reference number <b> {{auth()->user()->reference_number}} </b> or pay directly on the platform.</p> <br>

                <h3>Account details</h3> <br>
                <ul>
                    <li>Account number: 62746557399</li>
                    <li>Branch code: 250655</li>
                    <li>Bank: First National Bank</li>
                    <li>Swift code: FIRNZAJJ</li>
                    <li>Reference: <b> {{auth()->user()->reference_number}} </b> </li>
                </ul>

                <h3>Pay on the platform</h3> <br>

                <a href="/pay_now" class="btn btn-danger">Pay now</a>
            </div>
        </div>
    </div>
@endsection