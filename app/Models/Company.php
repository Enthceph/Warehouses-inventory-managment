<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_info',
    ];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function outlets()
    {
        return $this->hasMany(Outlet::class, 'company_id');
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'company_id');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'company_id', 'id');
    }
}
