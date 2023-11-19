<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataField;
use App\Models\FieldList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FieldListController extends Controller
{
    public function index()
    {
        $items = FieldList::all();

        return view('admin.fieldList.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // 'body' => 'required|max:255',
            'image' => 'image|file|required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('fieldList-images');
        }

        FieldList::create($validatedData);

        return redirect('/admin/lapangan')->with('success', 'Berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $fieldList = FieldList::findOrFail($id);

        $fieldList->name = $request->input('name');
        // $fieldList->body = $request->input('body');

        if ($request->hasFile('image')) {
            if ($fieldList->image) {
                Storage::delete($fieldList->image);
            }

            $imagePath = $request->file('image')->store('fieldList-images');
            $fieldList->image = $imagePath;
        }

        $fieldList->save();

        return redirect('/admin/lapangan')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        FieldList::destroy($id);

        return redirect('/admin/lapangan');
    }
}
