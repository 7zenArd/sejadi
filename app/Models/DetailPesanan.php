<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'pesanan_id',
        'menu_id',
        'jumlah',
        'subtotal',
        'printed',
        'note',
        'varian',
        'additionals',
        'dimsum_additionals',
        'additional_price',
        'base_price',
        'is_locked',
        'cancelled_qty',
        'cancellation_notes',
        'cancelled_at',
        'jumlah_asli',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'additionals' => 'json',
        'dimsum_additionals' => 'json',
        'additional_price' => 'decimal:2',
        'is_locked' => 'boolean',
        'created_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
