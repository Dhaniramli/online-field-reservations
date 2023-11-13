<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $item = PrivacyPolicy::where('id', 1)->first();

        return view('admin.privacyPolicy.index', compact('item'));
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ],[
            'required' => 'isi kolom yang masih kosong',
        ]);

        $item = new PrivacyPolicy([
            'id' => $request->input('id'),
            'body' => $request->input('body'),
        ]);
        $item->save();

        return redirect('/admin/kebijakan-privasi')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|max:255',
            'body' => 'required',
        ], [
            'required' => 'Isi kolom yang masih kosong',
        ]);
    
        $item = PrivacyPolicy::find($request->input('id'));
    
        $item->body = $request->input('body');
    
        $item->save();
    
        return redirect('/admin/kebijakan-privasi')->with('success', 'Berhasil disimpan!');
    }
    
    public function destroy($id) {
        $item = PrivacyPolicy::find($id);

        $item->delete();

        return redirect('/admin/kebijakan-privasi');
    }
}
