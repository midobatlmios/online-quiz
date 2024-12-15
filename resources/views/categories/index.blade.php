@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Categories</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-4">
        <i class="bi bi-plus-circle"></i> Add New Category
    </a>

    @if ($categories && count($categories) > 0)
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $category['name'] }}

                    <div>
                        <a href="{{ route('categories.edit', $category['id']) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center">No categories available.</p>
    @endif
</div>
@endsection
