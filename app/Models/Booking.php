<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'customer_name',
        'email',  // TAMBAHKAN INI!
        'package_name',
        'phone',
        'booking_date',
        'total_price',
        'dp_amount',
        'remaining_amount',
        'notes',
        'payment_proof',
        'payment_status',
        'rejection_reason',
        'rejected_at',
        'verified_at'
    ];
    
    protected $casts = [
        'booking_date' => 'date',
        'rejected_at' => 'datetime',
        'verified_at' => 'datetime',
        'total_price' => 'integer'
    ];
    
    // Scope untuk booking yang ditolak
    public function scopeRejected($query)
    {
        return $query->where('payment_status', 'rejected');
    }
    
    // Scope untuk booking yang sukses
    public function scopeSuccess($query)
    {
        return $query->where('payment_status', 'paid');
    }
    
    // Scope untuk booking pending
    public function scopePending($query)
    {
        return $query->whereIn('payment_status', ['pending', 'waiting_confirmation']);
    }
    
    // Scope untuk waiting confirmation
    public function scopeWaiting($query)
    {
        return $query->where('payment_status', 'waiting_confirmation');
    }
}