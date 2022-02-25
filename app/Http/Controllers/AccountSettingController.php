<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AccountSettingController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('auth.settings', [
            'title' => 'Account Setting',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'fullname' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()] 
        ]);

        $user = User::find($user->id);

        $user->name = $request->fullname;
        $user->username = $request->username;

        if(!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return back()->with('success', 'You have successfully update your account credentials.');
    }
}
