<?php

namespace App\Models;

use App\Enums\DocumentStatus;
use App\Enums\DocumentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_profile_id',
        'type',
        'file_path',
        'original_filename',
        'mime_type',
        'expiry_date',
        'status',
        'rejection_reason',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'type' => DocumentType::class,
        'status' => DocumentStatus::class,
        'expiry_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function workerProfile()
    {
        return $this->belongsTo(WorkerProfile::class);
    }

    public function verifiedByUser()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function isExpired(): bool
    {
        return $this->expiry_date !== null && $this->expiry_date->isPast();
    }

    public function isExpiringSoon(int $days = 30): bool
    {
        return $this->expiry_date !== null &&
               !$this->expiry_date->isPast() &&
               $this->expiry_date->diffInDays(now()) <= $days;
    }
}
