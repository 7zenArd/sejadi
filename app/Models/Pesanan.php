<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'no_meja',
        'status',
        'total',
        'note',
        'cancellation_reason',
        'cancelled_at',
        'location_type',
        'pickup_time',
        'discount_code',
        'discount_amount',
        'total_after_discount',
        'processed_at',
        'completed_at',
        'is_hidden',
        'archived_at',
        'location_area',
        'metode_pembayaran',
        'bank_qris',
        'is_final',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'discount_amount' => 'integer',
        'total_after_discount' => 'integer',
        'is_hidden' => 'boolean',
        'is_final' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
        'archived_at' => 'datetime',
    ];

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

    public function struk()
    {
        return $this->hasOne(Struk::class, 'pesanan_id');
    }

    public function historyArchive()
    {
        return $this->hasOne(HistoryArchive::class, 'pesanan_id');
    }
}
