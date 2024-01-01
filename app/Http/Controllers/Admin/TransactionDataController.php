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
    // public function index(Request $request)
    // {
    //     // dd($request);
    //     $date = $request->filled('date') ? $request->date : null;
    //     $month = $request->filled('month') ? sprintf("%02d", $request->month) : null;
    //     $year = $request->filled('year') ? $request->year : null;

    //     if ($request->status === 'selesai') {
    //         $itemsQuery = Transaction::where(function ($query) {
    //             $query->where('status_pay_early', 'paid')
    //                 ->orWhere('status_pay_final', 'paid');
    //         });

    //         if ($date && $month && $year) {
    //             $searchDate = "$year-$month-$date"; // Format tanggal: YYYY-MM-DD
    //             $itemsQuery->whereDate('created_at', $searchDate);
    //         } elseif ($date && $month) {
    //             // Jika hanya tanggal dan bulan yang ada isinya
    //             $searchDate = sprintf("%02d", $month) . '-' . sprintf("%02d", $date); // Format tanggal: MM-DD
    //             $itemsQuery->whereMonth('created_at', $month)->whereDay('created_at', $date);
    //         } elseif ($month && $year) {
    //             // Jika hanya bulan dan tahun yang ada isinya
    //             $searchDate = "$year-$month"; // Format tanggal: YYYY-MM
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         } elseif ($date) {
    //             // Jika hanya tanggal yang ada isinya
    //             $itemsQuery->whereDay('created_at', $date);
    //         } elseif ($month) {
    //             // Jika hanya bulan yang ada isinya
    //             $itemsQuery->whereMonth('created_at', $month);
    //         } elseif ($year) {
    //             // Jika hanya tahun yang ada isinya
    //             $itemsQuery->whereYear('created_at', $year);
    //         } elseif ($month && $year) {
    //             // Jika hanya bulan dan tahun yang ada isinya
    //             $searchDate = "$year-$month"; // Format tanggal: YYYY-MM
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         }

    //         $items = $itemsQuery->get();

    //         $status = 'selesai';

    //         return view('admin.transactionData.index', compact('items', 'status', 'date', 'year', 'month'));
    //     } else if ($request->status === 'belum-selesai') {
    //         $itemsQuery = Transaction::where(function ($query) {
    //             $query->where(function ($q) {
    //                 $q->where('status_pay_early', 'unpaid')
    //                     ->orWhere('status_pay_early', 'pending');
    //             })->orWhere(function ($q) {
    //                 $q->where('status_pay_final', 'unpaid')
    //                     ->orWhere('status_pay_final', 'pending');
    //             });
    //         });

    //         if ($date && $month && $year) {
    //             $searchDate = "$year-$month-$date";
    //             $itemsQuery->whereDate('created_at', $searchDate);
    //         } elseif ($date && $month) {
    //             $searchDate = sprintf("%02d", $month) . '-' . sprintf("%02d", $date);
    //             $itemsQuery->whereMonth('created_at', $month)->whereDay('created_at', $date);
    //         } elseif ($month && $year) {
    //             $searchDate = "$year-$month";
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         } elseif ($date) {
    //             $itemsQuery->whereDay('created_at', $date);
    //         } elseif ($month) {
    //             $itemsQuery->whereMonth('created_at', $month);
    //         } elseif ($year) {
    //             $itemsQuery->whereYear('created_at', $year);
    //         } elseif ($month && $year) {
    //             $searchDate = "$year-$month";
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         }

    //         $items = $itemsQuery->get();

    //         $status = 'belum-selesai';

    //         return view('admin.transactionData.index', compact('items', 'status', 'date', 'year', 'month'));
    //     } else if ($request->status === 'tidak-selesai') {
    //         $itemsQuery = Transaction::where(function ($query) {
    //             $query->where('status_pay_early', 'expire')
    //                 ->orWhere('status_pay_final', 'expire');
    //         });

    //         if ($date && $month && $year) {
    //             $searchDate = "$year-$month-$date";
    //             $itemsQuery->whereDate('created_at', $searchDate);
    //         } elseif ($date && $month) {
    //             $searchDate = sprintf("%02d", $month) . '-' . sprintf("%02d", $date);
    //             $itemsQuery->whereMonth('created_at', $month)->whereDay('created_at', $date);
    //         } elseif ($month && $year) {
    //             $searchDate = "$year-$month";
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         } elseif ($date) {
    //             $itemsQuery->whereDay('created_at', $date);
    //         } elseif ($month) {
    //             $itemsQuery->whereMonth('created_at', $month);
    //         } elseif ($year) {
    //             $itemsQuery->whereYear('created_at', $year);
    //         } elseif ($month && $year) {
    //             $searchDate = "$year-$month";
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         }

    //         $items = $itemsQuery->get();

    //         $status = 'tidak-selesai';

    //         return view('admin.transactionData.index', compact('items', 'status', 'date', 'year', 'month'));
    //     } else if ($request->status) {
    //         $items = [];
    //         $status = '';

    //         return view('admin.transactionData.index', compact('items', 'status', 'date', 'year', 'month'));
    //     } else {
    //         $status = '';
    //         $itemsQuery = Transaction::query();

    //         if ($date && $month && $year) {
    //             $searchDate = "$year-$month-$date";
    //             $itemsQuery->whereDate('created_at', $searchDate);
    //         } elseif ($date && $month) {
    //             $searchDate = sprintf("%02d", $month) . '-' . sprintf("%02d", $date);
    //             $itemsQuery->whereMonth('created_at', $month)->whereDay('created_at', $date);
    //         } elseif ($month && $year) {
    //             $searchDate = "$year-$month";
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         } elseif ($month && $year) {
    //             $searchDate = "$year-$month";
    //             $itemsQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
    //         } elseif ($date) {
    //             $itemsQuery->whereDay('created_at', $date);
    //         } elseif ($month) {
    //             $itemsQuery->whereMonth('created_at', $month);
    //         } elseif ($year) {
    //             $itemsQuery->whereYear('created_at', $year);
    //         }

    //         $items = $itemsQuery->get();

    //         return view('admin.transactionData.index', compact('items', 'status', 'date', 'year'));
    //     }
    // }

    public function index(Request $request)
    {
        // dd($request);
        $date1 = $request->filled('date1') ? $request->date1 : null;
        $date2 = $request->filled('date2') ? $request->date2 : null;

        $itemsQuery = Transaction::query();

        if ($request->status === 'selesai') {
            $itemsQuery->where(function ($query) {
                $query->where('status_pay_early', 'paid')
                    ->orWhere('status_pay_final', 'paid');
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
