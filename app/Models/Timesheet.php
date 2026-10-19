<?php

namespace App\Models;

use App\Enums\TimesheetStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'worker_id',
        'shift_id',
        'clock_in',
        'clock_out',
        'break_minutes',
        'hours',
        'hourly_rate',
        'client_hourly_rate',
        'worker_total_pay',
        'client_total_charge',
        'status',
        'client_approved_at',
        'client_approved_by',
        'rejection_reason',
        'notes',
    ];

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
        'client_approved_at' => 'datetime',
        'break_minutes' => 'integer',
        'hours' => 'decimal:2',
        'hourly_rate' => 'decimal:2',
        'client_hourly_rate' => 'decimal:2',
        'worker_total_pay' => 'decimal:2',
        'client_total_charge' => 'decimal:2',
        'status' => TimesheetStatus::class,
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function worker()
    {
        return $this->belongsTo(WorkerProfile::class, 'worker_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'client_approved_by');
    }

    public function calculateTotals(): void
    {
        if ($this->clock_in && $this->clock_out) {
            $totalMinutes = $this->clock_in->diffInMinutes($this->clock_out);
            $effectiveMinutes = max(0, $totalMinutes - ($this->break_minutes ?? 0));
            $this->hours = round($effectiveMinutes / 60, 2);
            $this->worker_total_pay = round($this->hours * (float)$this->hourly_rate, 2);
            $this->client_total_charge = round($this->hours * (float)$this->client_hourly_rate, 2);
        }
    }
}
