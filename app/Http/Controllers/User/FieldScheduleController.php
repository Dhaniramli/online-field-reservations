<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\PlayingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\FieldSchedule;

class FieldScheduleController extends Controller
{
    public function index($id)
    {
        $items = FieldSchedule::where('field_list_id', $id)->get();
        return view('user.fieldSchedule.index', compact('items'));
    }
}
