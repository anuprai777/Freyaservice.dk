<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'invoice_number',
        'staff_request_id',
        'period_start',
        'period_end',
        'issue_date',
        'due_date',
        'subtotal',
        'vat_rate',
        'vat_amount',
        'total',
        'currency',
        'status',
        'pdf_path',
        'payment_method',
        'notes',
        'paid_at',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'issue_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'vat_rate' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'status' => InvoiceStatus::class,
        'paid_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    public function staffRequest()
    {
        return $this->belongsTo(StaffRequest::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function calculateTotals(): void
    {
        $this->subtotal = $this->items()->sum('total');
        $this->vat_rate = 25.00; // Danish standard 25% moms
        $this->vat_amount = round($this->subtotal * 0.25, 2);
        $this->total = $this->subtotal + $this->vat_amount;
    }
}
