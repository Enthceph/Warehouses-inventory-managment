<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
    ];


    public function isAdministrator()
    {
        return
    }

    public function isOwner()
    {
        return
    }

    public function isAuditor()
    {
        return
    }

    public function isAccountant()
    {
        return
    }

    public function isManager()
    {
        return
    }

    public function isEmployee()
    {
        return
    }



}
//isAdministrator
//isOwner
//isAuditor
//isAccountant
//isManager
//isEmployee
