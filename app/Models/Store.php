<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'slug',
        'description',
        'logo_image',
        'cover_image',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    } // end of products

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
