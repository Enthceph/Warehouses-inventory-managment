<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
