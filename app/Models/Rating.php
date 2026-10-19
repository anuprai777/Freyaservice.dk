<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_request_id',
        'shift_id',
        'worker_id',
        'client_id',
        'rating',
        'punctuality_score',
        'quality_score',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
        'punctuality_score' => 'integer',
        'quality_score' => 'integer',
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

    public function client()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }
}
