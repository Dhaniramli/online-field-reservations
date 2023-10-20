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

    public $belanja;
    public $snapToken;
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
        $this->belanja = FieldSchedule::whereIn('id', $idsubah)->get();

        if (!empty($this->belanja)) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 10000,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->last_name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone_number,
                ),
            );
        }

        $this->snapToken = Snap::getSnapToken($params);

        return view('user.paymentConfirmation.mount');
    }
}
