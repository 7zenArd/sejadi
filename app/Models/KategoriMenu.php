<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    use HasFactory;

    protected $table = 'kategori_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'urutan',
        'support_additional',
        'support_dimsum_additional',
    ];

    protected $casts = [
        'support_additional' => 'boolean',
        'support_dimsum_additional' => 'boolean',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'kategori_id');
    }

    public function additionals()
    {
        return $this->hasMany(Additional::class, 'kategori_id');
    }
}
