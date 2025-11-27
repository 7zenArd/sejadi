<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;

    protected $table = 'additionals';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama',
        'harga',
        'kategori_id',
        'urutan',
        'is_active',
        'tipe',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class, 'kategori_id');
    }

    public function menuConfigs()
    {
        return $this->hasMany(MenuAdditionalsConfig::class, 'additional_id');
    }
}
