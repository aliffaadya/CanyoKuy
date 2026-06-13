<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'reset_token',
        'reset_token_expires',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'reset_token'
    ];

    // Hash password otomatis saat set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Verifikasi password
    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    // Generate reset token
    public function generateResetToken()
    {
        $this->reset_token = bin2hex(random_bytes(32));
        $this->reset_token_expires = now()->addHours(24);
        $this->save();
        return $this->reset_token;
    }
}