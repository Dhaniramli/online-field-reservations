<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowToorder;
use Illuminate\Http\Request;

class HowToorderController extends Controller
{
    public function index()
    {
        $item = HowToorder::where('id', 1)->first();

        return view('admin.howToorder.index', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ], [
            'required' => 'isi kolom yang masih kosong',
        ]);

        $item = new HowToorder([
            'id' => $request->input('id'),
            'body' => $request->input('body'),
        ]);
        $item->save();

        return redirect('/admin/cara-booking')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ], [
            'required' => 'Isi kolom yang masih kosong',
        ]);

        $item = HowToorder::find($request->input('id'));

        $item->body = $request->input('body');

        $item->save();

        return redirect('/admin/cara-booking')->with('success', 'Berhasil disimpan!');
    }

    public function destroy($id)
    {
        $item = HowToorder::find($id);

        $item->delete();

        return redirect('/admin/cara-booking');
    }
}
