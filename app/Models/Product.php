<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Controller::class, 'id', 'company_id');
    }

    public function category()
    {
        return $this->hasMany(ProductCategory::class, 'id', 'category_id');
    }
}
