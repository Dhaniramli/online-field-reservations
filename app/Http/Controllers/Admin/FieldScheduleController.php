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
            'date' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
            'price' => 'required',
        ], [
            'field_list_id.required' => 'isi kolom yang masih kosong',
            'date.required' => 'isi kolom yang masih kosong',
            'time_start.required' => 'isi kolom yang masih kosong',
            'time_finish.required' => 'isi kolom yang masih kosong',
            'price.required' => 'isi kolom yang masih kosong',
        ]);

        $jadwal = new FieldSchedule([
            'field_list_id' => $request->input('field_list_id'),
            'date' => $request->input('date'),
            'time_start' => $request->input('time_start'),
            'time_finish' => $request->input('time_finish'),
            'price' => $request->input('price'),
        ]);

        $jadwal->save();

        // return redirect('/admin/jadwal-lapangan/{id}')->with('success', 'Berhasil disimpan!');
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
