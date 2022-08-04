<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class,'meja','id');
    }
}
