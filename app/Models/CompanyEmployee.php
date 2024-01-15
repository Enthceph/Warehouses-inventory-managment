<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyEmployee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company_employees';

//    TODO проверить правильно ли сделаны отношения
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function empolyees()
    {
        return $this->hasMany(User::class, 'id', 'employee_id');
    }
}
