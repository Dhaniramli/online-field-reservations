<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FieldSchedule;
use Illuminate\Support\Carbon;
use App\Models\RequestCancelled;
use App\Exports\ExportTransaction;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TransactionDataController extends Controller
{
    public function index(Request $request)
    {

        if ($request->status === 'selesai') {
            $items = Transaction::where('status_pay_early', 'paid')
                ->orWhere('status_pay_final', 'paid')
                ->get();
            $status = 'selesai';

            return view('admin.transactionData.index', compact('items', 'status'));
        } else if ($request->status === 'belum-selesai') {
            $items = Transaction::where(function ($query) {
                $query->where('status_pay_early', 'unpaid')
                    ->orWhere('status_pay_early', 'pending');
            })->orWhere(function ($query) {
                $query->where('status_pay_final', 'unpaid')
                    ->orWhere('status_pay_final', 'pending');
            })->get();

            $status = 'belum-selesai';

            return view('admin.transactionData.index', compact('items', 'status'));
        } else if ($request->status === 'tidak-selesai') {
            $items = Transaction::where('status_pay_early', 'expire')
                ->orWhere('status_pay_final', 'expire')
                ->get();
            $status = 'tidak-selesai';

            return view('admin.transactionData.index', compact('items', 'status'));
        } else if ($request->status) {
            $items = [];
            $status = '';

            return view('admin.transactionData.index', compact('items', 'status'));
        } else {
            $status = '';
            $items = Transaction::all();

            return view('admin.transactionData.index', compact('items', 'status'));
        }
    }

    public function show($id)
    {
        $transactionDetail = Transaction::find($id);
        $user = User::find($transactionDetail->user_id);
        $idsubah = explode(',', $transactionDetail->schedule_ids);
        $belanja = FieldSchedule::whereIn('id', $idsubah)->get();
        $cancel = RequestCancelled::all();

        return view('admin.transactionData.show', compact('transactionDetail', 'belanja', 'cancel', 'user'));
    }

    public function destroy($id)
    {
        Transaction::destroy($id);
        return back();
    }

    public function export_excel()
    {
        $timestamp = Carbon::now()->format('Ymd');
        return (new ExportTransaction)->download('transaksi-' . $timestamp . '.xlsx');
    }
}
