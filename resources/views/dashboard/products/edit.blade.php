@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection

@section('content')
    <x-alert type="info" />
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.products._form', [
            'btn_label' => 'Update',
        ])

    </form>

@endsection
