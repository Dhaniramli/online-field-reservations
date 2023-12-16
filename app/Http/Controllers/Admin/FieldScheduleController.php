<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldList;
use App\Models\FieldSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class FieldScheduleController extends Controller
{
    public function index($id)
    {
        $fieldSchedules = FieldSchedule::where('field_list_id', $id)->get();

        $items = FieldList::where('id', $id)->first();

        return view('admin.fieldSchedule.index', compact('items', 'fieldSchedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_list_id' => 'required',
            'date.*' => 'required', // Gunakan 'date.*' untuk memvalidasi semua elemen dalam array
            'time_start.*' => 'required',
            'time_finish.*' => 'required',
            'price.*' => 'required',
        ], [
            'field_list_id.required' => 'Kolom ID lapangan harus diisi.',
            'date.*.required' => 'Kolom Tanggal harus diisi.',
            'time_start.*.required' => 'Kolom Jam Mulai harus diisi.',
            'time_finish.*.required' => 'Kolom Jam Selesai harus diisi.',
            'price.*.required' => 'Kolom Harga harus diisi.',
        ]);

        $dates = $request->input('date');
        $time_starts = $request->input('time_start');
        $time_finishes = $request->input('time_finish');
        $prices = $request->input('price');

        foreach ($dates as $key => $date) {
            $new_date = date('Ymd', strtotime($date));
            $new_time_start = date('Hi', strtotime($time_starts[$key]));
            // $new_time_finish = date('Hi', strtotime($time_finishes[$key]));
            $id_schedule = $new_date . $new_time_start;

            $fieldSchedules = FieldSchedule::find($id_schedule);

            if ($fieldSchedules) {
                return back()->with('error', 'Terdapat jadwal yang duplikasi!');
            } else {
                $jadwal = new FieldSchedule([
                    'id' => $id_schedule,
                    'field_list_id' => $request->input('field_list_id'),
                    'date' => $date,
                    'time_start' => $time_starts[$key],
                    'time_finish' => $time_finishes[$key],
                    'price' => $prices[$key],
                ]);

                $jadwal->save();
            }
        }

        return back()->with('success', 'Berhasil disimpan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
            'price' => 'required',
        ], [
            'date.required' => 'isi kolom yang masih kosong',
            'time_start.required' => 'isi kolom yang masih kosong',
            'time_finish.required' => 'isi kolom yang masih kosong',
            'price.required' => 'isi kolom yang masih kosong',
        ]);

        $jadwal = FieldSchedule::find($id);

        $jadwal->date = $request->input('date');
        $jadwal->time_start = $request->input('time_start');
        $jadwal->time_finish = $request->input('time_finish');
        $jadwal->price = $request->input('price');

        $jadwal->save();

        return back()->with('success', 'Berhasil disimpan!');
    }

    public function destroy($id)
    {
        FieldSchedule::destroy($id);

        return back();
    }
}
