<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama',
        'harga',
        'foto',
        'kategori_id',
        'available_variants',
        'stok',
        'support_additional',
        'support_dimsum_additional',
        'is_best_seller',
        'kategori_struk',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'available_variants' => 'json',
        'support_additional' => 'json',
        'support_dimsum_additional' => 'json',
        'is_best_seller' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class, 'kategori_id');
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'menu_id');
    }

    public function additionalConfigs()
    {
        return $this->hasMany(MenuAdditionalsConfig::class, 'menu_id');
    }
}
