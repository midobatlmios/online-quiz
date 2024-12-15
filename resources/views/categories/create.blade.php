@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Add New Category</h1>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Add Category</button>
    </form>
</div>
@endsection
