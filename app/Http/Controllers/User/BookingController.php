<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request) {
        $validatedData = $request->validate([
            'user_name' => 'required',
            'date' => 'required',
            'time' => 'required',
            'time_match' => 'required',
            'field_name' => 'required',
        ]);

        Booked::create($validatedData);

        return redirect('/')->with('success', 'Booking berhasil!');
    }
}
