<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use App\Models\DataField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Validasi manual
        // dd($request);
        $validator = Validator::make($request->all(), [
            // 'id' => 'required|unique:bookeds',
            'user_name' => 'required',
            'field_name' => 'required',
            'date' => 'required',
            'time' => 'required',
            'time_match' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            // Input masih kosong, tampilkan pesan kesalahan
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Input valid, lanjutkan dengan penyimpanan
        $validatedData = $validator->validated();

        Booked::create($validatedData);

        return redirect('/')->with('success', 'Booking berhasil!');
    }

    // public function store(Request $request)
    // {
    //     // Validasi manual
    //     $validator = Validator::make($request->all(), [
    //         // 'id' => 'required|unique:bookeds',
    //         'user_name' => 'required',
    //         'field_name' => 'required',
    //         'date' => 'required',
    //         'time' => 'required',
    //         'time_match' => 'required',
    //         'price' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         // Pengecekan tambahan untuk 'id'
    //         if ($request->has('id') && Booked::where('id', $request->id)->exists()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'errors' => $validator->errors(),
    //             ]);
    //         }

    //         // Input masih kosong atau ada kesalahan lainnya, tampilkan pesan kesalahan
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors(),
    //         ]);
    //     }

    //     // Input valid, lanjutkan dengan penyimpanan
    //     $validatedData = $validator->validated();

    //     Booked::create($validatedData);

    //     return response()->json(['success' => true, 'message' => 'Booking berhasil!']);
    // }



    public function getPrice(Request $request)
    {
        $fieldName = $request->input('field_name');
        $time = $request->input('time');
        $timeMatch = $request->input('time_match');

        // Lakukan kueri untuk mengambil harga dari tabel dataFields
        $price = DataField::where('field_list_id', $fieldName)
            ->where('playing_time_id', $time)
            ->value('price');

        $totalPrice = $price * $timeMatch;

        if ($price !== null) {
            return response()->json(['success' => true, 'price' => $totalPrice]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function checkId(Request $request)
    {
        $id = $request->input('id');

        // Lakukan pengecekan 'id' dalam database
        $exists = Booked::where('id', $id)->exists();

        return response()->json(['exists' => $exists]);
    }
}
