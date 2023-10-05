<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        "quantity",
        "unit_price",
        "total_value",
        //warehouse id
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}



