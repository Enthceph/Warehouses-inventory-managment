<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role'
    ];

    static public function getRoleId($name)
    {
        $role = self::where('role', $name)->first();

        if ($role) {
            return $role->id;
        }

        return null; // or any other default value or error handling mechanism you prefer
    }

    static public function getRoleByName($name)
    {
        return Role::where('role', $name)->first();
    }
}
