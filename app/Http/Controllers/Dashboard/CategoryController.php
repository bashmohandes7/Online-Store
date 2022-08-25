<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends Controller
{
    private CategoryInterface $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    } // end of construct


    public function index(Request $request)
    {
        return $this->categoryInterface->index($request);
    } // end of index

    public function create()
    {
        return $this->categoryInterface->create();
    } // end of create


    public function store(CategoryRequest $request)
    {
        return $this->categoryInterface->store($request);
    } // end of store


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return $this->categoryInterface->edit($category);
    } // end of edit


    public function update(CategoryRequest $request, Category $category)
    {
        return $this->categoryInterface->update($category, $request);
    } // end of update

    public function destroy(Category $category)
    {
        return $this->categoryInterface->destroy($category);
    } // end of destroy

    public function trash()
    {
        return $this->categoryInterface->trash();
    } // end of trash

    public function restore($id)
    {
        return $this->categoryInterface->restore($id);
    } // end of restore

    public function forceDelete($id)
    {
        return $this->categoryInterface->forceDelete($id);
    } // end of force Delete
} // end of class
