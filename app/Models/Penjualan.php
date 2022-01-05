<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id', 'id');
    }
}
