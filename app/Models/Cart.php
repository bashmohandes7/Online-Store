<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Observers\CartObserver;
use App\Models\Scopes\CookieScope;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'options',
        'quantity',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected static function booted()
    {
        static::observe(CartObserver::class);
        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', '=', Cart::getCookieId());
        });
    } // end of booted

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Anonymous']);
    } // end of user

    public function product()
    {
        return $this->belongsTo(Product::class);
    } // end of product
    public static function getCookieID()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        } // end of if
        return $cookie_id;
    } // end of getCookieID
} // end of product class
