<?php

namespace App\Http\Controllers\User;

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function render()
    {
        // Set your Merchant Server Key
        Config::$serverKey = 'SB-Mid-server-a8DzWcJyPpn6NoW9oF6aIcps';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );

        $snapToken = Snap::getSnapToken($params);

        dd($snapToken);
        return view('user.fieldSchedule.index');
    }
}
