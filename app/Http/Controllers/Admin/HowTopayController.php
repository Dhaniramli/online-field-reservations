<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowTopay;
use Illuminate\Http\Request;

class HowTopayController extends Controller
{
    public function index()
    {
        $item = HowTopay::where('id', 1)->first();

        return view('admin.howTopay.index', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ], [
            'required' => 'isi kolom yang masih kosong',
        ]);

        $item = new HowTopay([
            'id' => $request->input('id'),
            'body' => $request->input('body'),
        ]);
        $item->save();

        return redirect('/admin/pembayaran')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ], [
            'required' => 'Isi kolom yang masih kosong',
        ]);

        $item = HowTopay::find($request->input('id'));

        $item->body = $request->input('body');

        $item->save();

        return redirect('/admin/pembayaran')->with('success', 'Berhasil disimpan!');
    }

    public function destroy($id)
    {
        $item = HowTopay::find($id);

        $item->delete();

        return redirect('/admin/pembayaran');
    }
}
