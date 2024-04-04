<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FieldSchedule;
use App\Models\QueueList;
use App\Models\TransactionDetails;
use Carbon\Carbon;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        //CATATAN: JIKA MEMAKAI NGROK, SELALU PERIKSA DAN GANTI ALAMAT SERVERNYA DI MIDTRANS SESUAI NGROK BARU
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        $order = Transaction::where('id', $request->order_id)->first();
        $order2 = Transaction::where('final_id', $request->order_id)->first();
        $order_id = time() . mt_rand(1000, 9999);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                if ($order) {
                    //JIKA TOTAL SAMA DENGAN BAYAR MAKA UPDATE pay_final, SEBALIKNYA UPDATE pay_early
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'paid']);
                    } else {
                        $order->update(['status_pay_early' => 'paid']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'paid']);
                }

                //Ubah Status Jadwal Yang diPesan
                $idsubah = explode(',', $order->schedule_ids);
                $bookingToUpdate = [];

                foreach ($idsubah as $item_id) {
                    $booking = FieldSchedule::find($item_id);
                    $bookingToUpdate[] = $booking;
                }

                foreach ($bookingToUpdate as $booking) {
                    $booking->is_booked = 'booked';
                    $booking->save();

                    QueueList::where('field_schedule_id', $booking->id)->delete();
                }
                //AKHIR Ubah Status Jadwal Yang diPesan

            } else if ($request->transaction_status == 'expire') {
                if ($order) {
                    if ($order->status_pay_early === 'paid_final') {
                        // UNTUK PEMBAYARAN PENUH
                        $order->update(['status_pay_final' => 'expire']);
                        $order->delete();

                        //Ubah Status Jadwal Yang diPesan
                        $idsubah = explode(',', $order->schedule_ids);
                        $bookingToUpdate = [];

                        foreach ($idsubah as $item_id) {
                            $booking = FieldSchedule::find($item_id);
                            $bookingToUpdate[] = $booking;
                        }

                        foreach ($bookingToUpdate as $booking) {

                            QueueList::where('field_schedule_id', $booking->id)->where('status', true)->delete();

                            // KURANGI SEMUA DATA NUMBER DENGAN 1
                            $data = QueueList::where('field_schedule_id', $booking->id)->get();
                            foreach ($data as $queue) {
                                $queue->number -= 1;
                                $queue->save();
                            }

                            // JIKA SUDAH TIDAK ADA ANTRIAN MAKA LAPANGAN MENJADI AVAILABLE
                            if ($data->count() == 0) {
                                $booking->is_booked = 'available';
                                $booking->save();
                            }

                            // UBAH NUMBER 1 MENJADI TRUE DAN CREATED_AT MENJADI BARU
                            $dataOne = QueueList::where('field_schedule_id', $booking->id)
                                ->where('number', 1)
                                ->first();

                            if ($dataOne) {
                                $dataOne->status = true;
                                $dataOne->created_at = Carbon::now();
                                $dataOne->save();
                            }

                            // LAKUKAN BOOKING AUTO PADA ANTRIAN 1 JIKA ADA
                            if ($dataOne) {
                                // Mengonversi JSON ke dalam array
                                $queueData = json_decode($dataOne->queue_data, true);

                                // Sekarang Anda dapat mengakses data secara individual
                                $itemIdC = $queueData['id'];
                                $pilihanBayarC = $queueData['pilihanBayar'];
                                $tipePembayaranC = $queueData['tipePembayaran'];
                                $totalPriceC = $queueData['totalPrice'];
                                $first_nameC = $queueData['first_name'];
                                $last_nameC = $queueData['last_name'];
                                $emailC = $queueData['email'];
                                $phoneC = $queueData['phone'];

                                // Lakukan sesuatu dengan data yang diambil
                            }
                            $order_id = time() . mt_rand(1000, 9999);

                            $order_id_final = $order_id + 1;

                            \Midtrans\Config::$serverKey = 'SB-Mid-server-a8DzWcJyPpn6NoW9oF6aIcps';

                            // Lakukan pengecekan kondisi untuk jenis pembayaran
                            if ($tipePembayaranC === 'alfamart' || $tipePembayaranC === 'indomart') {
                                // Ubah nilai parameter sesuai dengan jenis pembayaran
                                $paymentType = 'cstore';
                                $bankTransfer = array(
                                    'cstore' => array(
                                        'store' => ($tipePembayaranC === 'alfamart') ? 'alfamart' : 'indomart',
                                        'message' => 'Terima Kasih Telah Menggunakan Layanan Kami',
                                    )
                                );
                            } else {
                                // Jika bukan alfamart atau indomart, gunakan metode pembayaran lainnya
                                $paymentType = 'bank_transfer';
                                $bankTransfer = array(
                                    'bank' => $tipePembayaranC
                                );
                            }

                            if ($pilihanBayarC === 'DP') {
                                $totalHasilDp = $totalPriceC / 2;

                                $params = array(
                                    'transaction_details' => array(
                                        'order_id' => $order_id,
                                        'gross_amount' => $totalHasilDp,
                                    ),
                                    'payment_type' => $paymentType, // Menentukan jenis pembayaran
                                    'customer_details' => array(
                                        'first_name' => $first_nameC,
                                        'last_name' => $last_nameC,
                                        'email' => $emailC,
                                        'phone' => $phoneC,
                                    ),
                                    $paymentType => $bankTransfer, // Menentukan detail pembayaran
                                    "custom_expiry" => array(
                                        "expiry_duration" => 3,
                                        "unit" => "minute",
                                    ),
                                );

                                Transaction::create([
                                    'id' => $order_id,
                                    'final_id' => $order_id_final,
                                    'schedule_ids' => $dataOne->field_schedule_id,
                                    'user_id' => $dataOne->user_id,
                                    'total_price' => $totalPriceC,
                                    'pay_early' => $totalHasilDp,
                                    'status_pay_early' => 'unpaid',
                                    'pay_final' => $totalHasilDp,
                                    'status_pay_final' => 'unpaid',
                                ]);
                            } else {
                                $params = array(
                                    'transaction_details' => array(
                                        'order_id' => $order_id,
                                        'gross_amount' => $totalPriceC,
                                    ),
                                    'payment_type' => $paymentType, // Menentukan jenis pembayaran
                                    'customer_details' => array(
                                        'first_name' => $first_nameC,
                                        'last_name' => $last_nameC,
                                        'email' => $emailC,
                                        'phone' => $phoneC,
                                    ),
                                    $paymentType => $bankTransfer, // Menentukan detail pembayaran
                                    "custom_expiry" => array(
                                        "expiry_duration" => 3,
                                        "unit" => "minute",
                                    ),
                                );

                                Transaction::create([
                                    'id' => $order_id,
                                    'final_id' => $order_id_final,
                                    'schedule_ids' => $dataOne->field_schedule_id,
                                    'user_id' => $dataOne->user_id,
                                    'total_price' => $totalPriceC,
                                    'pay_early' => $totalPriceC,
                                    'status_pay_early' => 'paid_final',
                                    'pay_final' => $totalPriceC,
                                    'status_pay_final' => 'unpaid',
                                ]);
                            }

                            $response = \Midtrans\CoreApi::charge($params);
                            // AKHIR LAKUKAN BOOKING AUTO PADA ANTRIAN 1 JIKA ADA
                        }
                        //AKHIR Ubah Status Jadwal Yang diPesan

                    } else if ($order->status_pay_final === 'unpaid') {
                        // UNTUK PEMBAYARAN DP
                        $order->update(['status_pay_early' => 'expire']);
                        $order->update(['status_pay_final' => 'expire']);
                        $order->delete();

                        //Ubah Status Jadwal Yang diPesan
                        $idsubah = explode(',', $order->schedule_ids);
                        $bookingToUpdate = [];

                        foreach ($idsubah as $item_id) {
                            $booking = FieldSchedule::find($item_id);
                            $bookingToUpdate[] = $booking;
                        }

                        foreach ($bookingToUpdate as $booking) {

                            QueueList::where('field_schedule_id', $booking->id)->where('status', true)->delete();

                            // KURANGI SEMUA DATA NUMBER DENGAN 1
                            $data = QueueList::where('field_schedule_id', $booking->id)->get();
                            foreach ($data as $queue) {
                                $queue->number -= 1;
                                $queue->save();
                            }

                            // JIKA SUDAH TIDAK ADA ANTRIAN MAKA LAPANGAN MENJADI AVAILABLE
                            if ($data->count() == 0) {
                                $booking->is_booked = 'available';
                                $booking->save();
                            }

                            // UBAH NUMBER 1 MENJADI TRUE DAN CREATED_AT MENJADI BARU
                            $dataOne = QueueList::where('field_schedule_id', $booking->id)
                                ->where('number', 1)
                                ->first();

                            if ($dataOne) {
                                $dataOne->status = true;
                                $dataOne->created_at = Carbon::now();
                                $dataOne->save();
                            }

                            // LAKUKAN BOOKING AUTO PADA ANTRIAN 1 JIKA ADA
                            if ($dataOne) {
                                // Mengonversi JSON ke dalam array
                                $queueData = json_decode($dataOne->queue_data, true);

                                // Sekarang Anda dapat mengakses data secara individual
                                $itemIdC = $queueData['id'];
                                $pilihanBayarC = $queueData['pilihanBayar'];
                                $tipePembayaranC = $queueData['tipePembayaran'];
                                $totalPriceC = $queueData['totalPrice'];
                                $first_nameC = $queueData['first_name'];
                                $last_nameC = $queueData['last_name'];
                                $emailC = $queueData['email'];
                                $phoneC = $queueData['phone'];

                                // Lakukan sesuatu dengan data yang diambil
                            }
                            $order_id = time() . mt_rand(1000, 9999);

                            $order_id_final = $order_id + 1;

                            \Midtrans\Config::$serverKey = 'SB-Mid-server-a8DzWcJyPpn6NoW9oF6aIcps';

                            // Lakukan pengecekan kondisi untuk jenis pembayaran
                            if ($tipePembayaranC === 'alfamart' || $tipePembayaranC === 'indomart') {
                                // Ubah nilai parameter sesuai dengan jenis pembayaran
                                $paymentType = 'cstore';
                                $bankTransfer = array(
                                    'cstore' => array(
                                        'store' => ($tipePembayaranC === 'alfamart') ? 'alfamart' : 'indomart',
                                        'message' => 'Terima Kasih Telah Menggunakan Layanan Kami',
                                    )
                                );
                            } else {
                                // Jika bukan alfamart atau indomart, gunakan metode pembayaran lainnya
                                $paymentType = 'bank_transfer';
                                $bankTransfer = array(
                                    'bank' => $tipePembayaranC
                                );
                            }

                            if ($pilihanBayarC === 'DP') {
                                $totalHasilDp = $totalPriceC / 2;

                                $params = array(
                                    'transaction_details' => array(
                                        'order_id' => $order_id,
                                        'gross_amount' => $totalHasilDp,
                                    ),
                                    'payment_type' => $paymentType, // Menentukan jenis pembayaran
                                    'customer_details' => array(
                                        'first_name' => $first_nameC,
                                        'last_name' => $last_nameC,
                                        'email' => $emailC,
                                        'phone' => $phoneC,
                                    ),
                                    $paymentType => $bankTransfer, // Menentukan detail pembayaran
                                    "custom_expiry" => array(
                                        "expiry_duration" => 3,
                                        "unit" => "minute",
                                    ),
                                );

                                Transaction::create([
                                    'id' => $order_id,
                                    'final_id' => $order_id_final,
                                    'schedule_ids' => $dataOne->field_schedule_id,
                                    'user_id' => $dataOne->user_id,
                                    'total_price' => $totalPriceC,
                                    'pay_early' => $totalHasilDp,
                                    'status_pay_early' => 'unpaid',
                                    'pay_final' => $totalHasilDp,
                                    'status_pay_final' => 'unpaid',
                                ]);
                            } else {
                                $params = array(
                                    'transaction_details' => array(
                                        'order_id' => $order_id,
                                        'gross_amount' => $totalPriceC,
                                    ),
                                    'payment_type' => $paymentType, // Menentukan jenis pembayaran
                                    'customer_details' => array(
                                        'first_name' => $first_nameC,
                                        'last_name' => $last_nameC,
                                        'email' => $emailC,
                                        'phone' => $phoneC,
                                    ),
                                    $paymentType => $bankTransfer, // Menentukan detail pembayaran
                                    "custom_expiry" => array(
                                        "expiry_duration" => 3,
                                        "unit" => "minute",
                                    ),
                                );

                                Transaction::create([
                                    'id' => $order_id,
                                    'final_id' => $order_id_final,
                                    'schedule_ids' => $dataOne->field_schedule_id,
                                    'user_id' => $dataOne->user_id,
                                    'total_price' => $totalPriceC,
                                    'pay_early' => $totalPriceC,
                                    'status_pay_early' => 'paid_final',
                                    'pay_final' => $totalPriceC,
                                    'status_pay_final' => 'unpaid',
                                ]);
                            }

                            $response = \Midtrans\CoreApi::charge($params);
                            // AKHIR LAKUKAN BOOKING AUTO PADA ANTRIAN 1 JIKA ADA
                        }
                        //AKHIR Ubah Status Jadwal Yang diPesan

                    } else {
                        // INI UNTUK PEMBAYARAN AKHIR
                        $order->update(['status_pay_final' => 'expire']);
                    }
                    $order->delete();
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'unpaid']);
                    $order2->update(['final_id' => $order_id]);
                }
            } else if ($request->transaction_status == 'settlement') {
                if ($order) {
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'paid']);
                    } else {
                        $order->update(['status_pay_early' => 'paid']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'paid']);
                }

                //Ubah Status Jadwal Yang diPesan
                $idsubah = explode(',', $order->schedule_ids);
                $bookingToUpdate = [];

                foreach ($idsubah as $item_id) {
                    $booking = FieldSchedule::find($item_id);
                    $bookingToUpdate[] = $booking;
                }

                foreach ($bookingToUpdate as $booking) {
                    $booking->is_booked = 'booked';
                    $booking->save();
                }
                //AKHIR Ubah Status Jadwal Yang diPesan

            } else if ($request->transaction_status == 'pending') {
                if ($order) {
                    if ($order->status_pay_early === 'paid_final') {
                        $order->update(['status_pay_final' => 'pending']);
                    } else {
                        $order->update(['status_pay_early' => 'pending']);
                    }
                } else if ($order2) {
                    $order2->update(['status_pay_final' => 'pending']);
                }
            }
        }
    }
}
