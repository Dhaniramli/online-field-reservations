<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\PlayingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\FieldList;
use App\Models\FieldSchedule;
use App\Models\QueueList;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class FieldScheduleController extends Controller
{
    public function field()
    {
        return view('user.fieldSchedule.field');
    }

    public function index(Request $request, $id)
    {
        $items = FieldSchedule::where('field_list_id', $id);

        $fieldList = FieldList::findOrFail($id);

        $queueList = QueueList::all();

        $transactions = Transaction::all();

        $user = Auth::user();

        // Inisialisasi variabel $dates jika Anda ingin menggunakannya
        $dates = [];

        // Filter data berdasarkan tanggal jika ada dalam permintaan
        if ($request->has('date')) {
            $selectedDate = $request->input('date');
            $items->where('date', 'like', '%' . $selectedDate . '%');
            $dates = [$selectedDate]; // Menambahkan tanggal yang difilter ke $dates
        } else {
            // Jika permintaan tidak memiliki tanggal, gunakan tanggal saat ini
            $currentDate = Carbon::now();
            $selectedDate = $currentDate->format('Y-m-d');
            $items->where('date', 'like', '%' . $selectedDate . '%');
            $dates = [$selectedDate];
        }

        // Mengambil data FieldSchedule
        $items = $items->get();

        return view('user.fieldSchedule.index', compact('items', 'dates', 'id', 'fieldList', 'queueList', 'user', 'transactions'));
    }
}
