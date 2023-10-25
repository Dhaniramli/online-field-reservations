<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fieldSchedule()
    {
        return $this->hasMany(FieldSchedule::class, 'field_schedule_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'booked_id');
    }
}
