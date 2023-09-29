<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DayDate;
use Illuminate\Http\Request;

class DayDateController extends Controller
{
    public function index() {
        $dayDates = DayDate::all();

        return view('admin.dayDate.index', compact('dayDates'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'id' => 'required|max:255',
            'max_year' => 'required|max:255',
        ]);

        DayDate::create($validatedData);

        return redirect('/admin/hari-tanggal')->with('success', 'Berita berhasil ditambahkan!');
    }
}
