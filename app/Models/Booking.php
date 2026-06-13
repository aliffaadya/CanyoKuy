<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    
    protected $fillable = [
        'booking_code',
        'package_name',
        'customer_name',
        'email',
        'phone',
        'participants',
        'booking_date',
        'total_price',
        'dp_amount',
        'remaining_amount',
        'notes',
        'payment_proof',
        'payment_status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}