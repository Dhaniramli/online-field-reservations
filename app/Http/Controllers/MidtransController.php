<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FieldSchedule;
use App\Models\TransactionDetails;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        //CATATAN: JIKA MEMAKAI NGROK, SELALU PERIKSA DAN GANTI ALAMAT SERVERNYA DI MIDTRANS SESUAI NGROK BARU
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        $order = Transaction::where('id', $request->order_id)->first();
        $order2 = Transaction::where('final_id', $request->order_id)->first();
        $order_id = time() . mt_rand(1000, 9999);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                if ($order) {
                    //JIKA TOTAL SAMA DENGAN BAYAR MAKA UPDATE pay_final, SEBALIKNYA UPDATE pay_early
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'paid']);
                    } else {
                        $order->update(['status_pay_early' => 'paid']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'paid']);
                }
            } else if ($request->transaction_status == 'expire') {
                if ($order) {
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'expire']);

                        //Ubah Status Jadwal Yang diPesan
                        $idsubah = explode(',', $order->schedule_ids);
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

                    } else if ($order->status_pay_final === 'unpaid') {
                        $order->update(['status_pay_early' => 'expire']);
                        $order->update(['status_pay_final' => 'expire']);

                        //Ubah Status Jadwal Yang diPesan
                        $idsubah = explode(',', $order->schedule_ids);
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

                    } else {
                        $order->update(['status_pay_final' => 'expire']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'unpaid']);
                    $order2->update(['final_id' => $order_id]);
                }
            } else if ($request->transaction_status == 'settlement') {
                if ($order) {
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'paid']);
                    } else {
                        $order->update(['status_pay_early' => 'paid']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'paid']);
                }
            } else if ($request->transaction_status == 'pending') {
                if ($order) {
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'pending']);
                    } else {
                        $order->update(['status_pay_early' => 'pending']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'pending']);
                }
            }
        }
    }
}
