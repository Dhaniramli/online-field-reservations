<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayDate extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'max_year'];
}
