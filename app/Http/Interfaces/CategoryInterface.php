<?php
 namespace App\Http\Interfaces;
interface CategoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show($category);
    public function edit($category);
    public function update($category, $request);
    public function destroy($category);
    public function trash();
    public function restore($id);
    public function forceDelete($id);
}
