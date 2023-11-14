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

        return redirect('/admin/lapangan')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'required' => 'isi kolom yang masih kosong'
        ]);

        $lapangan = FieldList::find($id);

        $lapangan->name = $request->input('name');

        $lapangan->save();

        return redirect('/admin/lapangan')->with('success', 'Berhasil disimpan!');
    }

    public function destroy($id)
    {
        FieldList::destroy($id);

        return redirect('/admin/lapangan');
    }
}
