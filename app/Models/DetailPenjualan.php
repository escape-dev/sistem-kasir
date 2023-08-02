<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'penjualan_id', 'barang_id', 'qty', 'subtotal'];

    public function barang() 
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
