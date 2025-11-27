<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'discount_codes';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $timestamps = false;
    protected $incrementing = false;

    protected $fillable = [
        'id',
        'code',
        'type',
        'value',
        'description',
        'is_active',
        'valid_from',
        'valid_until',
        'min_purchase',
        'max_usage',
        'current_usage',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'is_active' => 'boolean',
        'min_purchase' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
