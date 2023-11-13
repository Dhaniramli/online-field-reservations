<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocmedLinks;
use Illuminate\Http\Request;

class SocmedLinksController extends Controller
{
    public function index()
    {
        $items = SocmedLinks::all();

        return view('admin.socmedLinks.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:socmed_links',
            'link' => 'required|max:255',
        ], [
            'required' => 'isi kolom yang masih kosong',
            'unique' => 'sosial media sudah terisi',
        ]);

        $item = new SocmedLinks([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
        ]);
        $item->save();

        return redirect('/admin/tautan')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:socmed_links',
            'link' => 'required|max:255',
        ], [
            'required' => 'isi kolom yang masih kosong',
            'unique' => 'sosial media sudah terisi',
        ]);

        $item = SocmedLinks::find($id);

        $item->name = $request->input('name');
        $item->link = $request->input('link');

        $item->save();

        return redirect('/admin/tautan')->with('success', 'Berhasil disimpan!');
    }

    public function destroy($id)
    {
        $item = SocmedLinks::find($id);

        $item->delete();

        return redirect('/admin/tautan');
    }
}
