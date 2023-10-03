<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transaction_type(){
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
