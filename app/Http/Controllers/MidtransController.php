<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Transaction::where('order_id', $request->order_id)->first();
                if ($order) {
                    $order->update(['status' => 'paid']);
                }
            } else if ($request->transaction_status == 'expire') {
                $order = Transaction::where('order_id', $request->order_id)->first();
                if ($order) {
                    $order->update(['transaction_status' => 'expire']);
                }
            } else if ($request->transaction_status == 'settlement') {
                $order = Transaction::where('order_id', $request->order_id)->first();
                if ($order) {
                    $order->update(['status' => 'paid']);
                }
            } else if ($request->transaction_status == 'pending') {
                $order = Transaction::where('order_id', $request->order_id)->first();
                if ($order) {
                    $order->update(['status' => 'pending']);
                }
            }
        }
    }
}
