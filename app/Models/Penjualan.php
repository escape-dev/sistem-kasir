<?php

namespace App\Models;

use DateTime;
use DateTimeZone;

use App\Traits\Uuids;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id', 'id');
    }

    public static function createPenjualan($user_id, $items) 
    {
        $penjualan = Penjualan::create([
            "user_id" => $user_id,
            "date"    => new DateTime("now", new DateTimeZone('Asia/Jakarta')),
        ]);

        $mappedItem = $items->map(function($item, $key) use ($penjualan){
            Penjualan::reduceStok($item->id, $item->quantity);

            return [
                'id'           => Str::uuid(),
                'penjualan_id' => $penjualan->id,
                'barang_id'    => $item->id,
                'qty'          => $item->quantity,
                'subtotal'     => $item->quantity * $item->price,
            ];
        });

        return DetailPenjualan::insert($mappedItem->toArray());
    }

    public static function reduceStok($barang_id, $qty)
    {
        $barang       = Barang::findOrFail($barang_id);
        $barang->stok = $barang->stok - $qty;
        $barang->save();
    }
}
