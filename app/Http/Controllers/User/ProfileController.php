<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'team_name' => 'required|max:255',
        ], [
            'required' => 'Lengkapi data!',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        ]);


        User::where('id', $id)->update($validateData);

        return redirect('/profile')->with('success', 'Berhasil Disimpan!');
    }
}
