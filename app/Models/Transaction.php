<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\TransactionDetail;

class Transaction extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [];

    public function details(){
        return $this->hasMany(TransactionDetail::class , 'transactions_id');
    }
}
