<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataField extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fieldList(){
        return $this->belongsTo(FieldList::class, 'field_list_id');
    }
    public function playingTime(){
        return $this->belongsTo(PlayingTime::class, 'playing_time_id');
    }
}
