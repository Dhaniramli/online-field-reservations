<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataField;
use App\Models\FieldList;
use Illuminate\Http\Request;

class FieldListController extends Controller
{
    public function index()
    {
        $items = FieldList::all();

        return view('admin.fieldList.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'required' => 'isi kolom yang masih kosong'
        ]);

        $lapangan = new FieldList([
            'name' => $request->input('name'),
        ]);
        $lapangan->save();

        return redirect('/admin/sewa-lapangan')->with('success', 'Berhasil disimpan!');
    }

    // public function update(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required||numeric|unique:field_lists',
    //         'time' => 'required|array',
    //         'time.*' => 'required',
    //         'price' => 'required|array',
    //         'price.*' => 'required|numeric',
    //     ]);

    //     // Mengambil data lapangan yang akan diubah
    //     $lapangan = FieldList::find($id);

    //     if (!$lapangan) {
    //         return redirect('/admin/daftar-lapangan')->with('error', 'Lapangan tidak ditemukan!');
    //     }

    //     // Mengupdate data lapangan
    //     $lapangan->name = $request->input('name');
    //     $lapangan->save();

    //     // Simpan data harga perjam
    //     $times = $request->input('time');
    //     $prices = $request->input('price');

    //     // Hapus data harga perjam yang ada terlebih dahulu
    //     $lapangan->dataFields()->delete();

      

    //     return redirect('/admin/daftar-lapangan')->with('success', 'Berhasil diperbarui!');
    // }


    // public function destroy($id)
    // {
    //     FieldList::destroy($id);

    //     return redirect('/admin/daftar-lapangan');
    // }
}
