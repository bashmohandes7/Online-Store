<?php

namespace App\Http\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Interfaces\CategoryInterface;
use Illuminate\Support\Facades\Gate;
use Image;

class CategoryRepository implements CategoryInterface
{
    public function index($request)
    {
        if (Gate::denies('categories.index')) {
            abort(403);
        } // end of if
        $categories = Category::search($request)
            ->withoutTrashed()
            ->paginate();
        return view('dashboard.categories.index', compact('categories'));
    } // end of index


    public function create()
    {
        if (Gate::denies('categories.create')) {
            abort(403);
        } // end of if
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('parents', 'category'));
    } // end of create


    public function store($request)
    {
        if (Gate::denies('categories.create')) {
            abort(403);
        } // end of if
        $request_data = $request->except(['image']);
        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/category_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of if
        $request_data['slug'] = Str::slug($request_data['name']);

        Category::create($request_data);
        session()->flash('success', 'created successfully');
        return to_route('categories.index');
    } // end of store


    public function show($category)
    {
        if (Gate::denies('categories.index')) {
            abort(403);
        } // end of if
        $products = $category->products()->with('store')->latest()->paginate(5);
        return view('dashboard.categories.show', compact('category', 'products'));
    } // end of show


    public function edit($category)
    {
        if (Gate::denies('categories.update')) {
            abort(403);
        } // end of if
        if (!$category) {
            return to_route('categories.index')
                ->with('info', 'Record not found!');
        }
        /*
         * select * from categories
         * where `id` <> $id
         * AND (`parent_id` is null or parent_id <> $id)
         * */

        $parents = Category::where('id', '<>', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })
            ->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    } // end of edit


    public function update($category, $request)
    {
        if (Gate::denies('categories.create')) {
            abort(403);
        } // end of if
        $request_data = $request->except(['image']);

        if ($request->image) {
            if ($category->image != null) {
                Storage::disk('public_uploads')->delete('/category_images/' . $category->image);
            } //end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/category_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $request_data['slug'] = Str::slug($request_data['name']);

        $category->update($request_data);

        session()->flash('success', 'updated successfully');
        return to_route('categories.index');
    } // end of update

    /**
     * @param $category
     * @return mixed
     */
    public function destroy($category)
    {
        $category->delete();
        session()->flash('delete', 'deleted successfully');
        return to_route('categories.index');
    } // end of destroy

    public function trash()
    {
        $categories = Category::onlyTrashed()
        ->search(request())
        ->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    } // end of trash


    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        session()->flash('success', 'Restored Successfully');
        return to_route('categories.trash');
    } // end of restore

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if ($category->image != '') {
            Storage::disk('public_uploads')->delete('/category_images/' . $category->image);
        } //end of if

        $category->forceDelete();
        session()->flash('delete', 'deleted successfully');
        return to_route('categories.trash');
    } // end of force delete
} // end of class
