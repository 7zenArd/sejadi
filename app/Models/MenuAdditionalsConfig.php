<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAdditionalsConfig extends Model
{
    use HasFactory;

    protected $table = 'menu_additionals_config';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'menu_id',
        'additional_id',
        'is_allowed',
    ];

    protected $casts = [
        'is_allowed' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function additional()
    {
        return $this->belongsTo(Additional::class, 'additional_id');
    }
}
