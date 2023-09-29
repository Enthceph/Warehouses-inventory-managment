<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisation_id',
        'name',
        'address',

    ];

    public function organization()
    {
        return $this->belongsTo(Organisation::class, 'id', 'organisation_id');
    }
}
