<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'contact_info',
        'organisation_id'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'warehouse_id');
    }
}
