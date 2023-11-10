<?php

namespace App\Http\Controllers\User;

use Midtrans\Snap;
use Midtrans\Config;
use App\Http\Controllers\Controller;
use App\Models\FieldSchedule;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Illuminate\Support\Str;
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

    public function paymentDetail(Request $request, $ids)
    {
        $user = Auth::user();

        $metode = $request->query('metode');

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
        } else {
            if ($totalPrice != 0) {
                $gross_amount = $totalDp;
            }
        }

        return view('user.paymentConfirmation.mount', compact('belanja', 'totalPrice', 'ids', 'user', 'gross_amount'));
    }

    public function payNow(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $user = Auth::user();

        $order_id = time() . mt_rand(1000, 9999);

        $order_id_final = $order_id + 1;

        if ($request->totalPrice === $request->gross_amount) {
            $dataTransaksi = Transaction::create([
                'id' => $order_id,
                'final_id' => $order_id_final,
                'schedule_ids' => $request->ids,
                'user_id' => $user->id,
                'total_price' => $request->totalPrice,
                'pay_early' => $request->gross_amount,
                'status_pay_early' => 'paid_final',
                'pay_final' => $request->gross_amount,
                'status_pay_final' => 'unpaid',
            ]);
        } else {
            $dataTransaksi = Transaction::create([
                'id' => $order_id,
                'final_id' => $order_id_final,
                'schedule_ids' => $request->ids,
                'user_id' => $user->id,
                'total_price' => $request->totalPrice,
                'pay_early' => $request->gross_amount,
                'status_pay_early' => 'unpaid',
                'pay_final' => $request->gross_amount,
                'status_pay_final' => 'unpaid',
            ]);
        }

        //Ubah Status Jadwal Yang diPesan
        $idsubah = explode(',', $request->ids);
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
            $booking->is_booked = true;
            $booking->save();
        }
        //AKHIR Ubah Status Jadwal Yang diPesan

        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $request->gross_amount,
            ),
            'customer_details' => array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone_number,
            ),
        );

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken, 'dataTransaksi' => $dataTransaksi]);
    }

    public function generateSnapToken($id)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $user = Auth::user();
        $transactionDetail = Transaction::find($id);

        $paramsFull = array(
            'transaction_details' => array(
                'order_id' => $transactionDetail->final_id,
                'gross_amount' => $transactionDetail->pay_final,
            ),
            'customer_details' => array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone_number,
            ),
        );

        $snapToken = Snap::getSnapToken($paramsFull);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function destroy($id)
    {
        $transaksi = Transaction::find($id);

        //Ubah Status Jadwal Yang diPesan
        $idsubah = explode(',', $transaksi->schedule_ids);
        $bookingToUpdate = [];

        foreach ($idsubah as $item_id) {
            $booking = FieldSchedule::find($item_id);
            $bookingToUpdate[] = $booking;
        }

        foreach ($bookingToUpdate as $booking) {
            $booking->is_booked = false;
            $booking->save();
        }
        //AKHIR Ubah Status Jadwal Yang diPesan

        $transaksi->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
