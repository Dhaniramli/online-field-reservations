<?php

namespace App\Models;

use App\Models\Booked;
use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'total_price', 'pay_early', 'status_pay_early', 'pay_final', 'status_pay_final', 'schedule_ids', 'final_id'];

    public function booked()
    {
        return $this->hasMany(Booked::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
