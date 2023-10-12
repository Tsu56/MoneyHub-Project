<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'us_id',
        'payment_datetime',
        'payment_expired'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'us_id');
    }
}
