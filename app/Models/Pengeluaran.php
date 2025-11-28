<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $primaryKey = 'id';

    public $keyType = 'string';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'kategori',
        'deskripsi',
        'jumlah',
        'tanggal',
        'created_by',
        'bukti_url',
        'foto_url',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
