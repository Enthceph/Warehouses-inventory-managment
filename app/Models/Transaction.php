<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'amount',
        'description',
    ];


    public function type()
    {
        return $this->belongsTo(TransactionCategory::class, 'type_id');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }

//    public function inventory()
//    {
//        return $this->belongsTo(Inventory::class, 'inventory_id');
//    }

    public function product()
    {
        return $this->belongsTo(Inventory::class, 'product_id',);
    }

}
