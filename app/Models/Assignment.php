<?php

namespace App\Models;

use App\Enums\AssignmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_request_id',
        'shift_id',
        'worker_id',
        'status',
        'offered_at',
        'responded_at',
        'worker_hourly_rate',
        'client_hourly_rate',
        'notes',
    ];

    protected $casts = [
        'status' => AssignmentStatus::class,
        'offered_at' => 'datetime',
        'responded_at' => 'datetime',
        'worker_hourly_rate' => 'decimal:2',
        'client_hourly_rate' => 'decimal:2',
    ];

    public function staffRequest()
    {
        return $this->belongsTo(StaffRequest::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function worker()
    {
        return $this->belongsTo(WorkerProfile::class, 'worker_id');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
