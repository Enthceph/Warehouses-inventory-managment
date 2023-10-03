<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'organisation_employee';


    protected $fillable = [
        'organisation_id',
        'employee_id'
    ];


    public function organisation()
    {
        return $this->hasOne(Organisation::class, 'id', 'organisation_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
