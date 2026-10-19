<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skills',
        'city',
        'postcode',
        'lat',
        'lng',
        'hourly_rate',
        'rating_avg',
        'ratings_count',
        'availability_type',
        'status',
        'bank_reg_number',
        'bank_account_number',
        'notes',
    ];

    protected $casts = [
        'skills' => 'array',
        'lat' => 'float',
        'lng' => 'float',
        'hourly_rate' => 'decimal:2',
        'rating_avg' => 'decimal:2',
        'ratings_count' => 'integer',
        'bank_reg_number' => 'encrypted',
        'bank_account_number' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(WorkerDocument::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'worker_id');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class, 'worker_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'worker_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'worker_id');
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
