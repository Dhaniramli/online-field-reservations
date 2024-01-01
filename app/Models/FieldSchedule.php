<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'field_list_id', 'date', 'time_start', 'time_finish', 'price'];

    public function fieldList()
    {
        return $this->belongsTo(FieldList::class, 'field_list_id');
    }
}
