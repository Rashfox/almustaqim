<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeOtp extends Model
{
    use HasFactory;
    protected $table = 'kode_otp';
    protected $primaryKey = 'id';
    public $timestamps = true; 
    protected $fillable = ['email', 'otp', 'action', 'expires_at'];
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }
}