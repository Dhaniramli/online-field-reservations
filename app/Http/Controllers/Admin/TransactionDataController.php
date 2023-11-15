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
        $date = $request->date;

        if ($request->status === 'selesai') {
            $itemsQuery = Transaction::where(function ($query) {
                $query->where('status_pay_early', 'paid')
                    ->orWhere('status_pay_final', 'paid');
            });

            if ($request->filled('date')) {
                $itemsQuery->whereDate('created_at', $request->date);
            }

            $items = $itemsQuery->get();

            $status = 'selesai';

            return view('admin.transactionData.index', compact('items', 'status', 'date'));
        } else if ($request->status === 'belum-selesai') {
            $itemsQuery = Transaction::where(function ($query) {
                $query->where(function ($q) {
                    $q->where('status_pay_early', 'unpaid')
                        ->orWhere('status_pay_early', 'pending');
                })->orWhere(function ($q) {
                    $q->where('status_pay_final', 'unpaid')
                        ->orWhere('status_pay_final', 'pending');
                });
            });

            if ($request->filled('date')) {
                $itemsQuery->whereDate('created_at', $request->date);
            }

            $items = $itemsQuery->get();

            $status = 'belum-selesai';

            return view('admin.transactionData.index', compact('items', 'status', 'date'));
        } else if ($request->status === 'tidak-selesai') {
            $itemsQuery = Transaction::where(function ($query) {
                $query->where('status_pay_early', 'expire')
                    ->orWhere('status_pay_final', 'expire');
            });

            if ($request->filled('date')) {
                $itemsQuery->whereDate('created_at', $request->date);
            }

            $items = $itemsQuery->get();

            $status = 'tidak-selesai';

            return view('admin.transactionData.index', compact('items', 'status', 'date'));
        } else if ($request->status) {
            $items = [];
            $status = '';

            return view('admin.transactionData.index', compact('items', 'status', 'date'));
        } else {
            $status = '';
            $itemsQuery = Transaction::query();

            if ($request->filled('date')) {
                $itemsQuery->whereDate('created_at', $request->date);
            }

            $items = $itemsQuery->get();

            return view('admin.transactionData.index', compact('items', 'status', 'date'));
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

    public function export_excel(Request $request)
    {
        $statusAndDate = [
            'status' => $request->input('status'),
            'date' => $request->input('date'),
        ];

        $timestamp = Carbon::now()->format('Ymd');
        return (new ExportTransaction($statusAndDate))->download('transaksi-' . $timestamp . '.xlsx');
    }
}
