<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FieldSchedule;
use App\Models\RequestCancelled;
use App\Http\Controllers\Controller;

class RequestCancelledController extends Controller
{
    public function index()
    {
        $items = RequestCancelled::all();
        return view('admin.requestCancelled.index', compact('items'));
    }

    public function destroy(string $id)
    {
        $cancel = RequestCancelled::where('id', $id)->first();
        $cancel->delete();

        return redirect('/admin/permintaan-pembatalan');
    }

    public function confirm(string $id)
    {
        $cancel = RequestCancelled::where('id', $id)->first();

        if ($cancel) {
            $cancel->update([
                'status' => 'confirm'
            ]);

            $Transaction = Transaction::where('id', $cancel->transaction_id)->first();

            $idsubah = explode(',', $Transaction->schedule_ids);
            $bookingToUpdate = [];

            foreach ($idsubah as $item_id) {
                $booking = FieldSchedule::find($item_id);
                $bookingToUpdate[] = $booking;
            }

            foreach ($bookingToUpdate as $booking) {
                $booking->is_booked = false;
                $booking->save();
            }
        }

        return redirect('/admin/permintaan-pembatalan');
    }

    public function reject(string $id)
    {
        $cancel = RequestCancelled::where('id', $id)->first();

        if ($cancel) {
            $cancel->update([
                'status' => 'reject'
            ]);
            return redirect('/admin/permintaan-pembatalan');
        }

        return redirect('/admin/permintaan-pembatalan');
    }
}
