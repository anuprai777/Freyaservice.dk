<?php

namespace App\Models;

use App\Enums\ShiftStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_request_id',
        'title',
        'start_at',
        'end_at',
        'workers_needed',
        'status',
        'qr_secret_token',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'workers_needed' => 'integer',
        'status' => ShiftStatus::class,
    ];

    protected static function booted()
    {
        static::creating(function (Shift $shift) {
            if (empty($shift->qr_secret_token)) {
                $shift->qr_secret_token = Str::random(40);
            }
        });
    }

    public function staffRequest()
    {
        return $this->belongsTo(StaffRequest::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function getDurationHoursAttribute(): float
    {
        return round($this->start_at->diffInMinutes($this->end_at) / 60, 2);
    }
}
