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

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}
