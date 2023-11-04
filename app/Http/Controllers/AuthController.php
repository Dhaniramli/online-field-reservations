<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('auth.login.index');
    }

    public function indexRegister()
    {
        return view('auth.register.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:6'
        ], [
            'email.email' => 'Format email tidak valid.',
            'email.required' => 'Kolom email harus diisi.',
            'password.required' => 'Kolom kata sandi harus diisi.',
            'password.min' => 'Password harus memiliki setidaknya 6 karakter atau lebih.'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->with('loginError', 'Email tidak terdaftar.');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|unique:users,email|email:dns',
            'password' => 'required|min:6|max:255'
        ], [
            'required' => 'Lengkapi data!',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'email' => 'Format email tidak valid.',
            'unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password harus memiliki setidaknya 6 karakter atau lebih.'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }
}
