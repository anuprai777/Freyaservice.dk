<?php

namespace App\Models;

use App\Enums\StaffRequestReason;
use App\Enums\StaffRequestStatus;
use App\Enums\StaffRequestType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'request_type',
        'role',
        'workers_needed',
        'reason',
        'location',
        'city',
        'postcode',
        'lat',
        'lng',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'hours_per_week',
        'recurring_schedule',
        'dress_code',
        'instructions',
        'preferred_worker_id',
        'is_urgent',
        'status',
        'hourly_rate_offered',
    ];

    protected $casts = [
        'request_type' => StaffRequestType::class,
        'reason' => StaffRequestReason::class,
        'status' => StaffRequestStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'recurring_schedule' => 'array',
        'is_urgent' => 'boolean',
        'workers_needed' => 'integer',
        'hours_per_week' => 'decimal:2',
        'hourly_rate_offered' => 'decimal:2',
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function client()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function preferredWorker()
    {
        return $this->belongsTo(WorkerProfile::class, 'preferred_worker_id');
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
