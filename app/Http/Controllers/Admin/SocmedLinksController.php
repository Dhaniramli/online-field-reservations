<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocmedLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocmedLinksController extends Controller
{
    public function index()
    {
        $items = SocmedLinks::all();

        return view('admin.socmedLinks.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:socmed_links',
            'link' => 'required|max:255',
        ], [
            'required' => 'Isi kolom yang masih kosong',
            'unique' => 'Sosial media sudah terisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $item = new SocmedLinks([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
        ]);
        $item->save();

        return response()->json(['success' => 'Berhasil disimpan!']);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required|max:255',
        ], [
            'unique' => 'sosial media sudah terisi',
        ]);

        $item = SocmedLinks::find($id);

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
