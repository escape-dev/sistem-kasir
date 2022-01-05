<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}