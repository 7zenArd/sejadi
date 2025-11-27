<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryArchive extends Model
{
    use HasFactory;

    protected $table = 'history_archive';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $timestamps = false;
    protected $incrementing = false;

    protected $fillable = [
        'id',
        'pesanan_id',
        'week_number',
        'year',
        'export_history_id',
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function exportHistory()
    {
        return $this->belongsTo(ExportHistory::class, 'export_history_id');
    }
}
