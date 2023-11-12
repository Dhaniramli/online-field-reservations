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

        $cancel = RequestCancelled::all();

        if ($request->status === 'paid') {
            $transaction = Transaction::where('user_id', $user->id)->where('status_pay_final', 'paid')->latest('created_at')->get();
            $status = 'paid';

            return view('user.invoice.index', compact('transaction', 'status', 'cancel'));
        } else if ($request->status === 'pending') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query) {
                $query->where('status_pay_early', 'pending')
                    ->orWhere('status_pay_final', 'pending');
            })->latest('created_at')->get();
            $status = 'pending';

            return view('user.invoice.index', compact('transaction', 'status', 'cancel'));
        } else if ($request->status === 'expire') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query) {
                $query->where('status_pay_early', 'expire')
                    ->orWhere('status_pay_final', 'expire');
            })->latest('created_at')->get();
            $status = 'expire';

            return view('user.invoice.index', compact('transaction', 'status', 'cancel'));
        } else if ($request->status === 'unpaid') {
            $transaction = Transaction::where('user_id', $user->id)->where(function ($query) {
                $query->where('status_pay_early', 'unpaid')
                    ->orWhere('status_pay_early', 'pending')
                    ->orWhere('status_pay_final', 'unpaid')
                    ->orWhere('status_pay_final', 'pending');
            })->latest('created_at')->get();
            $status = 'expire';             

            $status = 'unpaid';

            return view('user.invoice.index', compact('transaction', 'status', 'cancel'));
        } else if ($request->status) {
            $transaction = [];

            return view('user.invoice.index', compact('transaction'));
        } else {
            $transaction = Transaction::where('user_id', $user->id)->latest('created_at')->get();
            $status = 'semua';

            return view('user.invoice.index', compact('transaction', 'status', 'cancel'));
        }
    }

    public function show($id)
    {
        $transactionDetail = Transaction::find($id);
        $idsubah = explode(',', $transactionDetail->schedule_ids);
        $belanja = FieldSchedule::whereIn('id', $idsubah)->get();
        $cancel = RequestCancelled::all();

        return view('user.invoice.show', compact('transactionDetail', 'belanja', 'cancel'));
    }

    public function cancel(Request $request, $id)
    {
        $user = Auth::user();
        $requestCancelled = RequestCancelled::where('transaction_id', $id)->first();

        if ($requestCancelled) {
            return response()->json(['success' => false, 'done' => ['common' => ['Silahkan tunggu proses pembatalan anda di periksa oleh admin']]], 422);
        }

        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'reason' => 'required|string',
        ]);

        $validator->setCustomMessages([
            'required' => 'Isi Semua Kolom',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => ['common' => ['Isi Semua Kolom']]], 422);
        }
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
