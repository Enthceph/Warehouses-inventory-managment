<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role'
    ];

    static public function getRoleId($name)
    {
        $role = self::where('role', $name)->first();

        if ($role) {
            return $role->id;
        }

        return null;
    }

    static public function getRoleByName($name)
    {
        return Role::where('role', $name)->first();
    }
}
