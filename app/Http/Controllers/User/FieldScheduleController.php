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

        $minDate = now(); // Tanggal hari ini
        $maxYear = 2023; // Tahun maksimum
        $dates = [];

        $currentYear = $minDate->year;
        $currentMonth = $minDate->month;

        // Set aplikasi Laravel ke bahasa Indonesia
        App::setLocale('id');

        while ($currentYear <= $maxYear) {
            $daysInMonth = Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;
            $startDay = ($currentYear == $minDate->year && $currentMonth == $minDate->month) ? $minDate->day : 1;

            foreach (range($startDay, $daysInMonth) as $day) {
                $date = Carbon::create($currentYear, $currentMonth, $day);
                $dates[] = [
                    'dateNoFormats' => $date->format('Y-m-d'),
                    'date' => $date->format('d F Y'),
                    'day' => $date->translatedFormat('l'),
                ];
            }

            if ($currentMonth < 12) {
                $currentMonth++;
            } else {
                $currentYear++;
                $currentMonth = 1;
            }
        }

        return view('user.fieldSchedule.index', compact('items', 'dates'));
    }
}
