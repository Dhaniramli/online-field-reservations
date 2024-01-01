<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FieldSchedule;
use App\Http\Controllers\Controller;
use App\Models\FieldList;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $user = User::where('is_admin', false)->get();
        $jadwalTersedia = FieldSchedule::where('is_booked', false)->whereDate('date', '>=', $now->toDateString())->get();
        $jadwalTerjual = FieldSchedule::where('is_booked', true)->whereYear('date', now()->year)->whereMonth('date', now()->month)->get();
        $lapangan = FieldList::all();

        return view('user.home', compact('user', 'jadwalTersedia', 'lapangan', 'jadwalTerjual'));
    }
}
