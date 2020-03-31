<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Transaction;
use App\Models\Product;

class TransactionDetail extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [];

    public function transaction(){
        return $this->belongsTo(Transaction::class , 'transactions_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class , 'products_id', 'id');
    }


}
