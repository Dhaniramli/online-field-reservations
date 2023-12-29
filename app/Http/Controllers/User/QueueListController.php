<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\QueueList;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueListController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $field_schedule_id = $request->input('field_schedule_id');

            $transactions = Transaction::where('user_id', $user->id)
                ->where(function ($query) use ($field_schedule_id) {
                    $query->where('schedule_ids', 'LIKE', '%' . $field_schedule_id . '%');
                })->first();

            if ($transactions) {
                // Jika entri sudah ada, kirimkan respons bahwa entri sudah ada
                return response()->json(['message' => 'Segera selesaikan pembayaran anda!!!.'], 200);
            }

            // Cek apakah entri dengan user_id yang sama dan field_schedule_id tertentu sudah ada
            $existingQueue = QueueList::where('user_id', $user->id)->where('field_schedule_id', $field_schedule_id)->first();

            $Queues = QueueList::where('field_schedule_id', $field_schedule_id)->get();

            if ($existingQueue) {
                // Jika entri sudah ada, kirimkan respons bahwa entri sudah ada
                return response()->json(['message' => 'Silahkan Tunggu, Anda sudah berada di dalam antrian.'], 200);
            }

            // Jika entri belum ada, lanjutkan untuk membuat entri baru
            $validatedData = $request->validate([
                'field_schedule_id' => 'required|max:255',
            ]);

            $validatedData['user_id'] = $user->id;
            $validatedData['number'] = count($Queues) + 1;

            QueueList::create($validatedData);

            return response()->json(['message' => 'Anda ditambahkan ke antrian.'], 200); // 200 untuk OK
        } else {
            return response()->json(['message' => 'Anda belum login, Silahkan login terlebih dahulu.'], 200);
        }
    }

    public function destroy($id)
    {
        $queueList = QueueList::where('field_schedule_id', $id)->get();

        foreach ($queueList as $queue) {
            $queue->number -= 1;
            $queue->save();
        }
        
        $dataZero = QueueList::where('field_schedule_id', $id)->where('number', 0)->first();

        if ($dataZero) {
            $dataZero->status = false;
            $dataZero->number = count($queueList);
            $dataZero->created_at = Carbon::now();
            $dataZero->save();
        }

        // UBAH NUMBER 1 MENJADI TRUE DAN CREATED_AT MENJADI BARU
        $dataOne = QueueList::where('field_schedule_id', $id)->where('number', 1)->first();
        if ($dataOne) {
            $dataOne->status = true;
            $dataOne->created_at = Carbon::now();
            $dataOne->save();
        }


        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
