<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataField;
use App\Models\FieldList;
use Illuminate\Http\Request;

class FieldListController extends Controller
{
    public function index() {
        $items = FieldList::all();

        $itemsTwo = DataField::all();

        return view('admin.fieldList.index', compact('items', 'itemsTwo'));
    }

    public function store(Request $request){
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|array',
            'time.*' => 'required|date_format:H:i',
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
                'time' => $time,
                'price' => $prices[$key],
            ]);
            $hargaPerjam->save();
        }

        return redirect('/admin/daftar-lapangan')->with('success', 'Berhasil ditambahkan!');   
    }

    public function destroy($id)
    {
        FieldList::destroy($id);

        return redirect('/admin/daftar-lapangan')->with('success', 'Berhasil dihapus!');
    }
}
