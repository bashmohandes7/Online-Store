<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_details';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withDefault(['name' => $this->product_name]);
    } // end of product

    public function order()
    {
        return $this->belongsTo(Order::class);
    } //end of order
}
