<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowTocancel extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'body'];
}
