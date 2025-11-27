<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struk extends Model
{
    use HasFactory;

    protected $table = 'struk';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'pesanan_id',
        'kasir_id',
        'total',
        'dibayar',
        'kembalian',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'dibayar' => 'decimal:2',
        'kembalian' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
