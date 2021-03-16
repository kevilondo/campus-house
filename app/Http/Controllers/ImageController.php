<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

use App\Models\Accomodation;

class ImageController extends Controller
{
    public function edit_pictures($id)
    {
        $accomodation = Accomodation::find($id);

        $images = $accomodation->image;

        return view('pages.accomodation.edit_pictures', compact(['images', 'accomodation']));
    }

    public function add_images($id, Request $request)
    {
        $this->validate($request, [
            'pictures' => 'required',
            'pictures. *' => 'mimes:jpg, jpeg, png'
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
                $newFilename = $id. rand(0, 100);

                //filename to store
                $fileNameToStore = '/storage/pictures/'. $newFilename . '.'. $extension;

                //filename to move
                $fileNameToMove = $newFilename. '.'. $extension;

                //Upload image
                $path = $picture->storeAs('/public/pictures', $fileNameToMove);

                $image = Image::create([
                    'accomodation_id' => $id,
                    'path' => $fileNameToStore
                ]);

            }

        }

        return redirect('/edit/pictures/'. $id)->with('success', 'Images have been added');
    }
}
