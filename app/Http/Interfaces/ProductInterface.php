<?php

namespace App\Http\Interfaces;

interface ProductInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($product);
    public function update($product, $request);
    public function destroy($product);
} // end of interface
