<?php

namespace App\Http\Controllers\User;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FieldSchedule;
use App\Http\Controllers\Controller;
use App\Models\RequestCancelled;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query) {
                $query->where('status_pay_early', 'pending')
                    ->orWhere('status_pay_final', 'pending');
            })->get();
            $status = 'pending';

            return view('user.invoice.index', compact('transaction', 'status'));
        } else if ($request->status === 'expire') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query) {
                $query->where('status_pay_early', 'expire')
                    ->orWhere('status_pay_final', 'expire');
            })->get();
            $status = 'expire';

            return view('user.invoice.index', compact('transaction', 'status'));
        } else if ($request->status === 'paid_final') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query) {
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

    public function show($id)
    {
        $transactionDetail = Transaction::find($id);
        $idsubah = explode(',', $transactionDetail->schedule_ids);
        $belanja = FieldSchedule::whereIn('id', $idsubah)->get();

        return view('user.invoice.show', compact('transactionDetail', 'belanja'));
    }

    public function cancel(Request $request, $id)
    {
        $user = Auth::user();
        $requestCancelled = RequestCancelled::find($id);

        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'reason' => 'required|string',
        ]);

        $validator->setCustomMessages([
            'required' => 'Isi Semua Kolom',
        ]);

        if ($validator->fails()) {
            // Jika validasi gagal, kembalikan respons JSON dengan pesan kesalahan
            return response()->json(['success' => false, 'errors' => ['common' => ['Isi Semua Kolom']]], 422);
        }
        //  else if ($requestCancelled->transaction_id === $id) {
        //     return response()->json(['success' => false, 'done' => 'sudahAda']);
        // }
         else {

            $cancel = RequestCancelled::create([
                'user_id' => $user->id,
                'transaction_id' => $id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'reason' => $request->reason,
            ]);

            return response()->json(['success' => true, 'message' => 'Pembatalan berhasil']);
        }
    }
}
