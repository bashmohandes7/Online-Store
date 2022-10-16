<?php

namespace App\Http\Repositories;

use Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Interfaces\ProductInterface;
use App\Models\Tag;

class ProductRepository implements ProductInterface
{
    public function index()
    {
        $products = Product::with(['store', 'category'])->paginate();
        return view('dashboard.products.index', compact('products'));
    } // end of index

    public function create()
    {
        $categories = Category::get();
        $product = new Product();
        $tags = new Tag();
        return view('dashboard.products.create', compact('categories', 'product', 'tags'));
    } // end of create
    public function store($request)
    {
        $request_data = $request->except(['image']);
        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of if
        $request_data['slug'] = Str::slug($request_data['name']);

        Category::create($request_data);
        session()->flash('success', 'created successfully');
        return to_route('products.index');
    } // end of store

    public function edit($product)
    {
        if (!$product) {
            return to_route('products.index')
                ->with('info', 'Record not found!');
        }
        /*
         * select * from categories
         * where `id` <> $id
         * AND (`parent_id` is null or parent_id <> $id)
         * */

        $categories = Category::where('id', '<>', $product->category_id)
            ->where(function ($query) use ($product) {
                $query->whereNull('id')
                    ->orWhere('id', '<>', $product->category_id);
            })
            ->get();
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact('product', 'categories', 'tags'));
    } // end of edit
    public function update($request, $product)
    {
        $request_data = $request->except(['image', 'tags']);
        if ($request->image) {
            if ($product->image != NULL) {
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            } //end of inner if
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of external if
        $request_data['slug'] = Str::slug($request_data['name']);
        $tags = json_decode($request->tags);
        $product->syncTags($tags);
        $product->update($request_data);
        session()->flash('success', 'Product updated successfully');
        return to_route('products.index');
    } // end of update
    public function destroy($product)
    {
    }
}
