<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayingTime extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataField(){
        return $this->hasMany(DataField::class);
    }
    public function dataFields()
    {
        return $this->hasMany(DataField::class, 'playing_time_id');
    }
}
