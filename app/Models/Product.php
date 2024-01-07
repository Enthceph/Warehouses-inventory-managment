<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
//        'organisation_id',
        'name',
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'id', 'organisation_id');
    }
}
