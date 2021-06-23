<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillField = ['name', 'description', 'price', 'photo'];

    function categories(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}
