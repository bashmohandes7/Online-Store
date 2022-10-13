<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'name',
        'slug',
        'description',
        'price',
        'rating',
        'compare_price',
        'image',
        'options',
        'status',
        'featured',
        'store_id',
        'category_id'
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('uploads/product_images/' . $this->image);
    } // end of get image path

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * ($this->compare_price - $this->price)), 2);
    }

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

    // Global Scope to return store if the user has store_id

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope);
    } // end of global scope

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withDefault(['name' => 'No Store']);
    } // end of store
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault(['name' => 'No Category']);
    } // end of store

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    } // end of tags

    public function syncTags(array $tags)
    {
        $tags_id = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::firstOrCreate([
                'slug' => Str::slug($tag_name->value),
            ], [
                'name' => trim($tag_name->value),
            ]);
            $tags_id[] = $tag->id;
        }
        $this->tags()->sync($tags_id);
    }
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    } // end of active

} // end of category class
