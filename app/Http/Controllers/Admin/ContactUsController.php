<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $item = ContactUs::where('id', 1)->first();

        return view('admin.contactUs.index', compact('item'));
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|email|max:255',
        ],[
            'required' => 'isi kolom yang masih kosong',
            'max' => 'maximal karakter 255',
            'email' => 'format email tidak valid'
        ]);

        $kontak = new ContactUs([
            'id' => $request->input('id'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
        ]);
        $kontak->save();

        return redirect('/admin/kontak-kami')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|email|max:255',
        ], [
            'required' => 'Isi kolom yang masih kosong',
            'max' => 'Maksimal karakter 255',
            'email' => 'Format email tidak valid',
        ]);
    
        $kontak = ContactUs::find($request->input('id'));
    
        $kontak->address = $request->input('address');
        $kontak->phone_number = $request->input('phone_number');
        $kontak->email = $request->input('email');
    
        $kontak->save();
    
        return redirect('/admin/kontak-kami')->with('success', 'Berhasil disimpan!');
    }
    
    public function destroy($id) {
        $kontak = ContactUs::find($id);

        $kontak->delete();

        return redirect('/admin/kontak-kami');
    }
}
