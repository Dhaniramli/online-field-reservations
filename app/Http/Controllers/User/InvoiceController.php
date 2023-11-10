<?php

namespace App\Http\Controllers\User;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->status === 'paid') {
            $transaction = Transaction::where('user_id', $user->id)->where('status_pay_final', 'paid')->get();
            $status = 'paid';

            return view('user.invoice.index', compact('transaction', 'status'));
        } else if ($request->status === 'pending') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query)
                {
                    $query->where('status_pay_early', 'pending')
                        ->orWhere('status_pay_final', 'pending');
                })->get();
                $status = 'pending';

            return view('user.invoice.index', compact('transaction', 'status'));
        } else if ($request->status === 'expire') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query)
            {
                $query->where('status_pay_early', 'expire')
                    ->orWhere('status_pay_final', 'expire');
            })->get();
            $status = 'expire';

            return view('user.invoice.index', compact('transaction', 'status'));
        } else if ($request->status === 'paid_final') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query)
                {
                    $query->where('status_pay_early', 'paid')
                        ->orWhere('status_pay_final', 'pending');
                })->get();
                $status = 'paid_final';

            return view('user.invoice.index', compact('transaction', 'status'));
        } else if ($request->status) {
            $transaction = [];

            return view('user.invoice.index', compact('transaction'));
        } else {
            $transaction = Transaction::where('user_id', $user->id)->get();
            $status = 'semua';

            return view('user.invoice.index', compact('transaction', 'status'));
        }
    }
}
