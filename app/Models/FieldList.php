<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldList extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fieldSchedule(){
        return $this->hasMany(FieldSchedule::class, 'field_list_id');
    }
}
