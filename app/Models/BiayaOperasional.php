<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaOperasional extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rentang()
    {
        return $this->belongsTo(Rentang::class);
    }
}
