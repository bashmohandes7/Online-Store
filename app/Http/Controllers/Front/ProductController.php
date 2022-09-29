<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    } // end of index

    public function show(Product $product)
    {
        if ($product->status != 'active') {
            return abort(404);
        }
        return view('front.product.show', compact('product'));
    } // end of show
}
