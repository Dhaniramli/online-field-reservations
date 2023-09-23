<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataField;
use App\Models\FieldList;
use App\Models\PlayingTime;
use Illuminate\Http\Request;

class FieldListController extends Controller
{
    public function index()
    {
        $items = FieldList::all();

        $itemsTwo = DataField::all();

        return view('admin.fieldList.index', compact('items', 'itemsTwo'));
    }

    public function create()
    {
        $items = PlayingTime::all();

        return view('admin.fieldList.create', compact('items'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|array',
            'time.*' => 'required',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
        ]);

        // Simpan data lapangan
        $lapangan = new FieldList([
            'name' => $request->input('name'),
        ]);
        $lapangan->save();

        // Simpan data harga perjam
        $times = $request->input('time');
        $prices = $request->input('price');

        foreach ($times as $key => $time) {
            $hargaPerjam = new DataField([
                'field_list_id' => $lapangan->id,
                'playing_time_id' => $time,
                'price' => $prices[$key],
            ]);
            $hargaPerjam->save();
        }

        return redirect('/admin/daftar-lapangan')->with('success', 'Berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $items = PlayingTime::all();
        $itemField = FieldList::find($id);
        $itemdatas = DataField::where('field_list_id', $id)->get();

        return view('admin.fieldList.edit', compact('items', 'itemField', 'itemdatas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|array',
            'time.*' => 'required',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
        ]);

        // Mengambil data lapangan yang akan diubah
        $lapangan = FieldList::find($id);

        if (!$lapangan) {
            return redirect('/admin/daftar-lapangan')->with('error', 'Lapangan tidak ditemukan!');
        }

        // Mengupdate data lapangan
        $lapangan->name = $request->input('name');
        $lapangan->save();

        // Simpan data harga perjam
        $times = $request->input('time');
        $prices = $request->input('price');

        // Hapus data harga perjam yang ada terlebih dahulu
        $lapangan->dataFields()->delete();

        // Simpan data harga perjam yang baru
        foreach ($times as $key => $time) {
            $hargaPerjam = new DataField([
                'field_list_id' => $lapangan->id,
                'playing_time_id' => $time,
                'price' => $prices[$key],
            ]);
            $hargaPerjam->save();
        }

        return redirect('/admin/daftar-lapangan')->with('success', 'Berhasil diperbarui!');
    }


    public function destroy($id)
    {
        FieldList::destroy($id);

        return redirect('/admin/daftar-lapangan');
    }
}
