<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
