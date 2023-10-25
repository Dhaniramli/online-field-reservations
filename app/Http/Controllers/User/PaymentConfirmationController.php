<?php

namespace App\Http\Controllers\User;

use Midtrans\Snap;
use Midtrans\Config;
use App\Http\Controllers\Controller;
use App\Models\FieldSchedule;
use App\Models\TransactionDetails;
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

    public function mount(Request $request, $ids)
    {
        if (!Auth::user()) {
        }

        $metode = $request->query('metode');

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $idsubah = explode(',', $ids);
        $belanja = FieldSchedule::whereIn('id', $idsubah)->get();

        $totalPrice = 0;

        foreach ($belanja as $item) {
            $totalPrice += $item->price;
        }

        $totalDp = $totalPrice / 2;

        if ($metode == 'bayar_penuh') {
            if ($totalPrice != 0) {
                $gross_amount = $totalPrice;
            }
        } elseif ($metode == 'bayar_dp') {
            if ($totalDp != 0) {
                $gross_amount = $totalDp;
            }
        }

        $user = Auth::user();

        if (!empty($belanja)) {
            $paramsFull = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $gross_amount,
                ),
                'customer_details' => array(
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone_number,
                ),
            );
        }

        $snapToken = Snap::getSnapToken($paramsFull);

        return view('user.paymentConfirmation.mount', compact('belanja', 'snapToken', 'totalPrice', 'gross_amount', 'ids', 'user'));
    }

    public function updateTrue($ids)
    {
        $idsubah = explode(',', $ids);
        $bookingToUpdate = [];

        foreach ($idsubah as $id) {
            $booking = FieldSchedule::find($id);

            if (!$booking) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            if ($booking->is_booked) {
                return response()->json(['message' => 'Jadwal sudah di-booking oleh orang lain.'], 400);
            } else {
                $bookingToUpdate[] = $booking;
            }
        }

        foreach ($bookingToUpdate as $booking) {
            $booking->is_booked = false;
            // $booking->is_booked = true;
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

    // public function onPending(Request $request)
    // {
    //     try {
    //         $transaction = TransactionDetails::create([
    //             'status_code' => $request['status_code'],
    //             'status_message' => $request['status_message'],
    //             'transaction_id' => $request['transaction_id'],
    //             'order_id' => $request['order_id'],
    //             'gross_amount' => $request['gross_amount'],
    //             'payment_type' => $request['payment_type'],
    //             'transaction_time' => $request['transaction_time'],
    //             'transaction_status' => $request['transaction_status'],
    //             'fraud_status' => $request['fraud_status'],
    //             'payment_code' => $request['payment_code'],
    //             'pdf_url' => $request['pdf_url'],
    //             'finish_redirect_url' => $request['finish_redirect_url'],
    //         ]);

    //         // Informasi sukses disimpan
    //         return "Data transaksi berhasil disimpan";
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan
    //         return "Gagal menyimpan data transaksi: " . $e->getMessage();
    //     }
    // }

    public function onPending(Request $request)
    {
        try {
            $requestData = $request->all();

            // Menggabungkan data 'result' dan 'bookingId' ke dalam satu array
            $transactionData = array_merge($requestData['result'], [
                'booking_id' => $requestData['bookingId']
            ]);

            // Membuat dan menyimpan data transaksi
            $transaction = TransactionDetails::create($transactionData);

            // Informasi sukses disimpan
            return "Data transaksi berhasil disimpan";
        } catch (\Exception $e) {
            // Tangani kesalahan
            return "Gagal menyimpan data transaksi: " . $e->getMessage();
        }
    }
}
