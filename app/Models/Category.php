<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function transactiontype(){
        return $this->belongsTo(TransactionType::class);
    }
    
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
