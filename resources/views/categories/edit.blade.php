@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Category</h1>

    <form method="POST" action="{{ route('categories.update', $category['id']) }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category['name'] }}" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Category</button>
    </form>
</div>
@endsection
