<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportHistory extends Model
{
    use HasFactory;

    protected $table = 'export_history';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $timestamps = false;
    protected $incrementing = false;

    protected $fillable = [
        'id',
        'export_type',
        'export_category',
        'file_name',
        'file_path',
        'file_url',
        'date_from',
        'date_to',
        'total_transactions',
        'total_revenue',
        'total_pengeluaran',
        'total_pemasukan',
        'exported_by',
    ];

    protected $casts = [
        'total_revenue' => 'decimal:2',
        'total_pengeluaran' => 'decimal:2',
        'total_pemasukan' => 'decimal:2',
        'date_from' => 'datetime',
        'date_to' => 'datetime',
        'exported_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function historyArchives()
    {
        return $this->hasMany(HistoryArchive::class, 'export_history_id');
    }
}
