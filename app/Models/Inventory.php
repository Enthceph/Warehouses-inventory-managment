<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventories';

    protected $fillable = [
        "quantity",
        "unit_price",
        "total_value",
        "expires_at",
        "warehouse_id",
        "product_id"
    ];

    public function product()
    {
        return $this->hasOne(Product::class, "id", "product_id");
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, "warehouse_id", "id");
    }
}



