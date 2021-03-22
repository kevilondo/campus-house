<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;

class PagesController extends Controller
{

    public function index() 
    {
        $accomodations = Accomodation::with('thumbnail')->orderBy('created_at', 'desc')->get();

        return view('index')->with('accomodations', $accomodations);
    }

    public function browse()
    {
        return view('pages.browse');
    }

    public function payment_instructions()
    {
        return view('pages.payment_instructions');
    }

}
