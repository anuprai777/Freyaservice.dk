<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'cvr',
        'address',
        'city',
        'postcode',
        'contact_person',
        'phone',
        'billing_email',
        'industry',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staffRequests()
    {
        return $this->hasMany(StaffRequest::class, 'client_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'client_id');
    }

    public function favouriteWorkers()
    {
        return $this->belongsToMany(WorkerProfile::class, 'favourite_workers', 'client_id', 'worker_id')
                    ->withPivot('notes')
                    ->withTimestamps();
    }
}
