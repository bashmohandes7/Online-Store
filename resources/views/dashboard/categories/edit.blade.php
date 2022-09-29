@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection

@section('content')
<x-alert type="info" />
    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.categories._form', [
            'btn_label' => 'Update',
        ])

    </form>

@endsection
