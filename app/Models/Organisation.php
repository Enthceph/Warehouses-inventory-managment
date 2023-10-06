<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_info',
        'employees',
        'owner_id'
    ];

//    public function employees()
//    {
//        return $this->hasMany(OrganisationEmployee::class)->where('id', );
//    }


    public function outlets(): HasMany
    {
        return $this->hasMany(Outlet::class, 'organisation_id');
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'organisation_id');
    }
}
