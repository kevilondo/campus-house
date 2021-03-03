<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    //edit profile
    public function profile()
    {
        $user = auth()->user();

        return view('pages.profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone_number' => 'required|numeric|digits:10',
            'password' => 'confirmed'
        ]);

        if ($request->password)
        {
            $user = User::find($user_id)->update([
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => bcrypt($request->password)
            ]);
        }
        else
        {
            $user = User::find($user_id)->update([
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);
        }

        return redirect('/profile')->with('success', 'Your profile has been updated');
    }
}
