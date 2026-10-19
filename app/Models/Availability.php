<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_profile_id',
        'day_of_week',
        'specific_date',
        'start_time',
        'end_time',
        'is_available',
        'type',
    ];

    protected $casts = [
        'day_of_week' => 'integer',
        'specific_date' => 'date',
        'is_available' => 'boolean',
    ];

    public function workerProfile()
    {
        return $this->belongsTo(WorkerProfile::class);
    }

    public function getDayNameAttribute(): string
    {
        $days = [
            0 => 'Søndag',
            1 => 'Mandag',
            2 => 'Tirsdag',
            3 => 'Onsdag',
            4 => 'Torsdag',
            5 => 'Fredag',
            6 => 'Lørdag',
        ];

        return $days[$this->day_of_week] ?? 'Ugedag';
    }
}
