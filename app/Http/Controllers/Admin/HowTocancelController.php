<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowTocancel;
use Illuminate\Http\Request;

class HowTocancelController extends Controller
{
    public function index()
    {
        $item = HowTocancel::where('id', 1)->first();

        return view('admin.howTocancel.index', compact('item'));
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ],[
            'required' => 'isi kolom yang masih kosong',
        ]);

        $item = new HowTocancel([
            'id' => $request->input('id'),
            'body' => $request->input('body'),
        ]);
        $item->save();

        return redirect('/admin/pembatalan')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ], [
            'required' => 'Isi kolom yang masih kosong',
        ]);
    
        $item = HowTocancel::find($request->input('id'));
    
        $item->body = $request->input('body');
    
        $item->save();
    
        return redirect('/admin/pembatalan')->with('success', 'Berhasil disimpan!');
    }
    
    public function destroy($id) {
        $item = HowTocancel::find($id);

        $item->delete();

        return redirect('/admin/pembatalan');
    }
}
