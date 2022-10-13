<?php

namespace App\Http\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartInterface
{
    public function get(): Collection;

    public function add(Product $product, $quantity = 1);

    public function update($id, $quantity);

    public function delete($id);

    public function empty();

    public function total(): float;
} // end of interface
