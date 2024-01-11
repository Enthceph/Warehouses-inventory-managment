<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "warehouses";

    protected $fillable = [
        'name',
        'location',
        'contact_info',
        'company_id'
    ];

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'warehouse_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
