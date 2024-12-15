@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        background: url('{{ asset('images/quiz/3308619.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Press Start 2P', cursive;
        color: #fff;
    }

    .container {
        max-width: 900px;
        margin: auto;
        background: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
    }

    h1, p {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    h1 {
        color: #FFD700; /* Gold for the title */
        margin-bottom: 20px;
    }

    p {
        color: #DDD; /* Light gray for description */
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .card {
        background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.5);
    }

    .card-header {
        background: #FF5722; /* Bright orange for card headers */
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 10px 10px 0 0;
        padding: 15px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
    }

    .card-body {
        padding: 20px;
    }

    .form-check-label {
        font-size: 0.95rem;
        color: #FFF; /* Keep options text consistent with the design */
    }

    .form-check-input:checked + .form-check-label {
        color: #FFD700; /* Highlight selected option */
    }

    .form-check-input {
        accent-color: #FF9800; /* Match input with orange theme */
        transform: scale(1.2); /* Slightly enlarge radio buttons */
    }

    .btn-success {
        background: #4CAF50; /* Bright green for submit button */
        border: none;
        font-size: 1.2rem;
        font-weight: bold;
        padding: 15px;
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-success:hover {
        background: #388E3C; /* Darker green on hover */
        box-shadow: 0px 5px 15px rgba(72, 239, 72, 0.6);
    }
</style>

<div class="container">
    <h1 class="text-center">{{ $quiz['title'] }}</h1>
    <p class="text-center">{{ $quiz['description'] }}</p>

    <!-- Timer Display -->
    <div class="alert alert-info text-center" id="timer">
        Time Remaining: <span id="time-left">05:00</span>
    </div>

    <!-- Quiz Form -->
    <form method="POST" action="{{ route('quiz.submit', $quiz['id']) }}" id="quiz-form">
        @csrf
        @foreach ($quiz['questions'] as $index => $question)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Question {{ $index + 1 }}:</h5>
                </div>
                <div class="card-body">
                    <p>{{ $question['question_text'] }}</p>
                    @foreach ($question['options'] as $option)
                        <div class="form-check">
                            <input type="radio" class="form-check-input" 
                                   name="question_{{ $question['id'] }}" 
                                   value="{{ $option['id'] }}" 
                                   id="option_{{ $option['id'] }}" 
                                   required>
                            <label class="form-check-label" for="option_{{ $option['id'] }}">
                                {{ $option['option_text'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success w-100">Submit Quiz</button>
    </form>
</div>

<!-- JavaScript Timer -->
<script>
    // Set the countdown time in seconds (e.g., 5 minutes = 300 seconds)
    let timeRemaining = 90;

    function updateTimer() {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;

        // Display the time in MM:SS format
        document.getElementById('time-left').textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        // If time runs out, submit the form automatically
        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            alert('Time is up! Submitting your quiz.');
            document.getElementById('quiz-form').submit();
        }

        timeRemaining--;
    }

    // Update the timer every second
    const timerInterval = setInterval(updateTimer, 1000);

    // Initialize the timer display
    updateTimer();
</script>
@endsection
