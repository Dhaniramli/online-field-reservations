<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlayingTime;
use Illuminate\Http\Request;

class FieldScheduleController extends Controller
{
    public function index() {
        $playingTimes = PlayingTime::all();

        return view('admin.fieldSchedule.index', compact('playingTimes'));
    }
}
