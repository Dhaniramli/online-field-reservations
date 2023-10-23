<?php

namespace App\Http\Controllers\User;

use Midtrans\Snap;
use Midtrans\Config;
use App\Http\Controllers\Controller;
use App\Models\FieldSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentConfirmationController extends Controller
{
    public function index($ids)
    {
        $idsubah = explode(',', $ids);
        $items = FieldSchedule::whereIn('id', $idsubah)->get();

        return view('user.paymentConfirmation.index', compact('items'));
    }

    public function mount($ids)
    {
        if (!Auth::user()) {
        }

        // Set your Merchant Server Key
        Config::$serverKey = 'SB-Mid-server-a8DzWcJyPpn6NoW9oF6aIcps';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        // Ambil data belanja
        $idsubah = explode(',', $ids);
        $belanja = FieldSchedule::whereIn('id', $idsubah)->get();

        // Inisialisasi total harga
        $totalPrice = 0;

        foreach ($belanja as $item) {
            $totalPrice += $item->price;
        }

        $totalDp = $totalPrice / 2;

        $user = Auth::user();

        if (!empty($belanja)) {
            $paramsFull = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => intval($totalPrice),
                ),
                'customer_details' => array(
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone_number,
                ),
            );

            $paramsDp = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => intval($totalDp),
                ),
                'customer_details' => array(
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone_number,
                ),
            );
        }

        $snapTokenFull = Snap::getSnapToken($paramsFull);
        $snapTokenDp = Snap::getSnapToken($paramsDp);

        return view('user.paymentConfirmation.mount', compact('belanja', 'snapTokenFull', 'snapTokenDp', 'totalPrice', 'totalDp', 'ids', 'user'));
    }

    public function updateTrue($ids)
    {
        $idsubah = explode(',', $ids);
        $bookingToUpdate = []; // Array untuk menyimpan jadwal yang ingin di-update

        foreach ($idsubah as $id) {
            $booking = FieldSchedule::find($id);

            // Periksa apakah data ditemukan
            if (!$booking) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            // Pengecekan apakah sudah di-booking
            if ($booking->is_booked) {
                return response()->json(['message' => 'Jadwal sudah di-booking oleh orang lain.'], 400);
            } else {
                // Tambahkan jadwal ke dalam array untuk di-update
                $bookingToUpdate[] = $booking;
            }
        }

        // Jika semua jadwal dapat di-booking, lakukan pembaruan
        foreach ($bookingToUpdate as $booking) {
            $booking->is_booked = true;
            $booking->save();
        }

        return response()->json(['message' => 'Data berhasil diupdate']);
    }


    public function updateFalse($ids)
    {
        $idsubah = explode(',', $ids);
        foreach ($idsubah as $id) {
            $booking = FieldSchedule::find($id);

            // Periksa apakah data ditemukan
            if (!$booking) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            // Update kolom is_booked menjadi true
            $booking->is_booked = false;
            $booking->save();
        }

        return response()->json(['message' => 'Data berhasil diupdate']);
    }
}
