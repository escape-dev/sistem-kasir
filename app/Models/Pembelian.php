<?php

namespace App\Models;

use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function pemasok() 
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id', 'id');
    }
}
