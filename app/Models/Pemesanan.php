<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function datameja()
    {
        return $this->hasOne(meja::class,'id','meja');
    }
    public function pemesanandetail()
    {
        return $this->hasMany(PemesananDetail::class,'id_pemesanan','id');
    }
    
}
