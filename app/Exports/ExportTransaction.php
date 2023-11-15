<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\FieldSchedule;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTransaction implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $data = Transaction::query();

        return $data;
    }

    public function map($transaksi): array
    {
        $idsubah = explode(',', $transaksi->schedule_ids);
        $belanja = FieldSchedule::whereIn('id', $idsubah)->get();

        $transactionDetails = [
            'First Name' => $transaksi->user->first_name,
            'Last Name' => $transaksi->user->last_name,
            'Team Name' => $transaksi->user->team_name,
            'Phone Number' => $transaksi->user->phone_number,
            'Email' => $transaksi->user->email,
            'Total Price' => $transaksi->total_price,
        ];

        $rows = [];

        if ($belanja->count() > 1) {
            foreach ($belanja as $key => $item) {
                if ($key === 0) {
                    $row = array_merge($transactionDetails, [
                        'Field Name' => $item->fieldList->name,
                        'Date' => $item->date,
                        'Time Start' => $item->time_start,
                        'Time Finish' => $item->time_finish,
                        'Price' => $item->price,
                    ]);
                } else {
                    $row = [
                        'First Name' => '',
                        'Last Name' => '',
                        'Team Name' => '',
                        'Phone Number' => '',
                        'Email' => '',
                        'Total Price' => '',
                        'Field Name' => $item->fieldList->name,
                        'Date' => $item->date,
                        'Time Start' => $item->time_start,
                        'Time Finish' => $item->time_finish,
                        'Price' => $item->price,
                    ];
                }
                $rows[] = $row;
            }
        } else {
            $row = array_merge($transactionDetails, [
                'Field Name' => $belanja->first()->fieldList->name,
                'Date' => $belanja->first()->date,
                'Time Start' => $belanja->first()->time_start,
                'Time Finish' => $belanja->first()->time_finish,
                'Price' => $belanja->first()->price,
            ]);
            $rows[] = $row;
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Nama Depan',
            'Nama Belakang',
            'Nama Tim',
            'Nomor Telpon',
            'Email',
            'Total Harga',
            'Nama Lapangan',
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Harga',
        ];
    }
}
