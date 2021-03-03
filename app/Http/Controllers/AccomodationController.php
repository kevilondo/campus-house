<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;
use App\Models\Image;

class AccomodationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'filter']);
        $this->middleware('edit')->only(['edit']);
    }

    public function form()
    {
        return view('pages.accomodation.form');
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'rent' => 'required',
            'room_type' => 'required',
            'picture. *' => 'required|mimes:jpg, jpeg, png'
        ]);

        $accomodation = Accomodation::create([
            'name' => $request->name,
            'address' => $request->address,
            'rent' => $request->rent,
            'room_type' => $request->room_type,
            'user_id' => auth()->user()->id
        ]);

        $pictures = $request->file('pictures');

        if ($pictures)
        {
            foreach ($pictures as $picture)
            {
                //get filename with extension
                $filenameWithExt = $picture->getClientOriginalName();

                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                //get just the extension
                $extension = $picture->getClientOriginalExtension();

                //new file name
                $newFilename = $accomodation->id. rand(0, 100);

                //filename to store
                $fileNameToStore = '/storage/pictures/'. $newFilename . '.'. $extension;

                //filename to move
                $fileNameToMove = $newFilename. '.'. $extension;

                //Upload image
                $path = $picture->storeAs('/public/pictures', $fileNameToMove);

                $image = Image::create([
                    'accomodation_id' => $accomodation->id,
                    'path' => $fileNameToStore
                ]);
            }
        }

        return redirect('/add_accomodation')->with('success', 'Your accomodation has been added');
    }

    public function show($id)
    {
        $accomodation = Accomodation::find($id);

        return view('pages.accomodation.show', compact('accomodation'));
    }

    public function filter(Request $request)
    {
        $this->validate($request, [
            'room_type' => 'required',
            'rent' => 'required'
        ]);

        $room_type = $request->room_type;
        $rent = $request->rent;

        $accomodations = Accomodation::Where('room_type', $room_type)->where('rent', '<=', $rent)->get();

        return view('pages.browse')->with('accomodations', $accomodations);
    }

    public function my_accomodations()
    {
        $accomodations = auth()->user()->accomodation;

        return view('pages.accomodation.my_accomodations', compact('accomodations'));
    }

    public function edit($id)
    {
        $accomodation = Accomodation::find($id);

        return view('pages.accomodation.edit', compact('accomodation'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'rent' => 'required',
            'room_type' => 'required'
        ]);

        $accomodation = Accomodation::find($id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'rent' => $request->rent,
            'room_type' => $request->room_type
        ]);

        return redirect('/edit/'. $id)->with('success', 'Your property has been edited');
    }
}
