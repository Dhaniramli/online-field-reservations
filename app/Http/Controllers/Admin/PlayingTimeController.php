<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlayingTime;
use Illuminate\Http\Request;

class PlayingTimeController extends Controller
{
    public function index()
    {

        $items = PlayingTime::all();

        return view('admin.timeList.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required',
        ]);

        PlayingTime::create([
            'time' => $request->input('time'),
        ]);

        return redirect('/admin/jam-main')->with('success', 'Berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'time' => 'required',
        ]);

        PlayingTime::where('id', $id)->update([
            'time' => $request->input('time'),
        ]);

        return redirect('/admin/jam-main')->with('success', 'Berhasil disimpan!');
    }

    public function destroy($id)
    {
        PlayingTime::destroy($id);

        return redirect('/admin/jam-main');
    }
}
