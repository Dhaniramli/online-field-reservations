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
        $date1 = $request->filled('date1') ? $request->date1 : null;
        $date2 = $request->filled('date2') ? $request->date2 : null;

        $itemsQuery = Transaction::query();

        if ($request->status === 'selesai') {
            $itemsQuery->where(function ($query) {
                $query->Where('status_pay_final', 'paid');
            });
        } elseif ($request->status === 'belum-selesai') {
            $itemsQuery->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('status_pay_early', 'unpaid')
                        ->orWhere('status_pay_early', 'pending');
                })->orWhere(function ($q) {
                    $q->where('status_pay_final', 'unpaid')
                        ->orWhere('status_pay_final', 'pending');
                });
            });
        } elseif ($request->status === 'tidak-selesai') {
            $itemsQuery->where(function ($query) {
                $query->where('status_pay_early', 'expire')
                    ->orWhere('status_pay_final', 'expire');
            });
        }

        if ($date1 !== null && $date2 !== null) {
            $date2 = date('Y-m-d', strtotime($date2 . '+1 day')); // Tambah 1 hari untuk mengambil data sampai akhir tanggal yang dimaksud

            $itemsQuery->whereBetween('created_at', [$date1, $date2]);
        }

        $items = $itemsQuery->get();
        $status = $request->status ?? '';

        return view('admin.transactionData.index', compact('items', 'status'));
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
