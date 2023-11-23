<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'outlet_id',
        'date',
        'type',
        'amount',
        'description',
        'inventory_id',
        'product_name',
    ];
}
