@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        background: url('{{ asset('images/quiz/3308619.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Press Start 2P', cursive; /* Retro game font */
        color: #fff;
    }

    .game-container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        background: rgba(0, 0, 0, 0.85); /* Semi-transparent black */
        border-radius: 15px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.8);
    }

    h1, h2, h3 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .category-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
    }

    .category-row h3 {
        margin: 0;
        font-size: 1.5rem;
    }

    .category-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-primary {
        background: #ff9800;
        border: none;
        font-weight: bold;
        text-transform: uppercase;
        transition: background 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 0 8px rgba(255, 152, 0, 0.7);
    }

    .btn-primary:hover {
        background: #e68900;
        box-shadow: 0 0 12px rgba(230, 137, 0, 1);
    }

    .btn-danger {
        background: #e74c3c;
        border: none;
        transition: background 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 0 8px rgba(231, 76, 60, 0.7);
    }

    .btn-danger:hover {
        background: #c0392b;
        box-shadow: 0 0 12px rgba(192, 57, 43, 1);
    }

    .card {
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        border: none;
        border-radius: 10px;
    }

    .card h5 {
        font-size: 1.2rem;
    }

    .card a {
        background: #28a745;
        color: #fff;
        transition: background 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 0 8px rgba(40, 167, 69, 0.7);
    }

    .card a:hover {
        background: #218838;
        box-shadow: 0 0 12px rgba(33, 136, 56, 1);
    }
</style>

<div class="game-container">
    <h1 class="text-center">Available Quizzes</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Categories Section -->
    <div class="categories-section mb-5">
        <h2>Categories</h2>

        <!-- Add New Category Button -->
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Add New Category
        </a>

        <!-- List of Categories -->
        @if ($categories && count($categories) > 0)
            @foreach ($categories as $category)
                <div class="category-row">
                    <h3>{{ $category['name'] }}</h3>

                    <div class="category-buttons">
                        <!-- Edit Category -->
                        <a href="{{ route('categories.edit', $category['id']) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <!-- Delete Category -->
                        <form action="{{ route('categories.destroy', $category['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No categories available.</p>
        @endif
    </div>

    <!-- Quizzes Section -->
    @foreach ($categories as $category)
        <h3>{{ $category['name'] }}</h3>
        <div class="row">
            @foreach ($category['quizzes'] as $quiz)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $quiz['title'] }}</h5>
                            <p class="card-text">{{ $quiz['description'] }}</p>
                            <a href="{{ route('quiz.show', $quiz['id']) }}" class="btn btn-primary">Take Quiz</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
