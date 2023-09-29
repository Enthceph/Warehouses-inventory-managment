<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'contact_info',
        'employees',
        'owner_id'
    ];

//    public function employees()
//    {
//        return $this->hasMany(Employee::class)->where('id', );
//    }

    public function outlets(): HasMany
    {
        return $this->hasMany(Outlet::class, 'organisation_id');
    }
}
