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

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required|min:6'
        ], [
            'email.email' => 'Format email tidak valid.',
            'email.required' => 'Kolom email harus diisi.',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password harus memiliki setidaknya 6 karakter atau lebih.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $emailToCheck = $request->input('email');

        $existingUser = User::where('email', $emailToCheck)->first();

        if ($existingUser) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Email atau Password salah.'], 401);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Email tidak terdaftar.'], 401);
        }
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
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated(); // Ambil data yang telah divalidasi

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return response()->json(['success' => true]);
    }
}
