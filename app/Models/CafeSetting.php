<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeSetting extends Model
{
    use HasFactory;

    protected $table = 'cafe_settings';

    protected $primaryKey = 'id';

    public $keyType = 'string';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'is_open',
        'closed_message',
        'best_seller_auto_mode',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'best_seller_auto_mode' => 'boolean',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
