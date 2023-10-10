<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    use HasFactory;

    // protected $fillable = ['id', 'user_name', 'field_name', 'date', 'time', 'time_match', 'price'];
    protected $guarded = ['id'];
}
