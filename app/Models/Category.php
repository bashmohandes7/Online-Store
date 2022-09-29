<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'slug',
        'image',
        'status'
    ];
    protected $appends = ['image_path'];
    protected $perPage = 10;

    public function getImagePathAttribute()
    {
        return asset('uploads/category_images/' . $this->image);
    } // end of get image path

    // search by name and status category
    public function scopeSearch(Builder $query, $search)
    {
        $query->when(request()->query('name'), function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search->name}%");
        });

        $query = $query->when(request()->query('status'), function ($q) use ($search) {
            $q->where('status', 'LIKE', "%{$search->status}%");
        });
    } // end of scope search

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault(['name' => 'No Parent']);
    } // end of parent

    public function products()
    {
        return $this->hasMany(Product::class);
    } // end of products

}
