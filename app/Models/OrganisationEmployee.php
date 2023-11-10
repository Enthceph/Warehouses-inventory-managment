<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganisationEmployee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organisation_employee';

//    protected $fillable = [
//        'organisation_id',
//        'employee_id'
//    ];

    public function organisation()
    {
        return $this->hasOne(Organisation::class, 'id', 'organisation_id');
    }

    public function empolyees()
    {
        return $this->hasMany(User::class, 'id', 'employee_id');
    }
}
