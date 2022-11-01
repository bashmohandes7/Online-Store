@extends('layouts.dashboard')

@section('title', 'Import Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Import Products</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.import') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Product Count</label>
            <x-form.input class="form-control-lg" name="count" />
        </div>
        <button type="submit" class="btn btn-primary">Start Import...</button>
    </form>

@endsection
