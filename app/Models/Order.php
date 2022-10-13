<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\OrderAddress;
use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public const BILLING_ADDRESS = "billing";
    public const SHIPPING_ADDRESS = "shipping";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'user_id',
        'payment_method',
        'status',
        'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'Guest Customer']);
    } // end of user
    public function store()
    {
        return $this->belongsToMany(Store::class);
    } // end of store

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_details',
            'order_id',
            'product_id',
            'id',
            'id'
        )
            ->using(OrderDetails::class)
            ->withPivot(['product_name', 'price', 'quantity', 'options']);
    } // end of products

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', Order::BILLING_ADDRESS);
    } // end of billingAddress

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', Order::SHIPPING_ADDRESS);
    } // end of shippingAddress

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    } // end of addresses
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(fn (Order $order) => $order->number = Order::getNextOrderNumber());
    } // end of booted

    protected static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');
        return $number ? $number + 1 : $year . '0001';
    } // end of getNextOrderNumber
}
