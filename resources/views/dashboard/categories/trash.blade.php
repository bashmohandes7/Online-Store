@extends('layouts.dashboard')

@section('title', 'Trashed Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Trashed</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back</a>
    </div>
    <x-alert type="success" />
    <x-alert type="delete" alert="danger" />

    {{-- Search form --}}
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-primary mx-2">Filter</button>
    </form>
    {{-- end of search form --}}

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th colspan="2"> Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><img src="{{ $category->image_path }}" alt="" height="100"></td>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->parent->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <form action="{{ route('categories.restore', $category->id) }}" method="post">
                            @csrf
                            <!-- Form Method Spoofing -->
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('categories.forceDelete', $category->id) }}" method="post">
                            @csrf
                            <!-- Form Method Spoofing -->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No categories defined.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->withQueryString()->links() }}
@endsection
