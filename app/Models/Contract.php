<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'worker_id',
        'client_id',
        'staff_request_id',
        'type',
        'start_date',
        'end_date',
        'hourly_rate',
        'terms',
        'file_path',
        'status',
        'signed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_at' => 'datetime',
        'hourly_rate' => 'decimal:2',
    ];

    public function worker()
    {
        return $this->belongsTo(WorkerProfile::class, 'worker_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function staffRequest()
    {
        return $this->belongsTo(StaffRequest::class);
    }
}
