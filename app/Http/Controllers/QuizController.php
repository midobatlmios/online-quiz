<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    private $data;

    public function __construct()
    {
        // Load quiz data from QuizData.php
        $this->data = collect(require app_path('Data/QuizData.php'));
    }

    public function index()
    {
        $categories = $this->data->get('categories');
        return view('quiz.index', ['categories' => $categories]);
    }

    public function show($id)
{
    $categories = $this->data->get('categories');
    $quiz = collect($categories)
        ->flatMap(function ($category) {
            return $category['quizzes'];
        })
        ->firstWhere('id', $id);

    if (!$quiz) {
        abort(404, 'Quiz not found');
    }

    // Remove this line after debugging
    // dd($quiz);

    return view('quiz.show', ['quiz' => $quiz]);
}

    public function submit(Request $request, $id)
    {
        // Fetch all categories
        $categories = $this->data->get('categories');

        // Find the quiz by ID
        $quiz = collect($categories)
            ->flatMap(function ($category) {
                return $category['quizzes'];
            })
            ->firstWhere('id', $id);

        if (!$quiz) {
            abort(404, 'Quiz not found');
        }

        // Calculate the score
        $score = 0;
        foreach ($quiz['questions'] as $question) {
            $userAnswer = $request->input("question_{$question['id']}");
            $correctOption = collect($question['options'])->firstWhere('is_correct', true);

            if ($correctOption && $userAnswer == $correctOption['id']) {
                $score++;
            }
        }

        // Redirect back with the user's score
        return redirect()->route('quiz.index')->with('success', "You scored {$score} out of " . count($quiz['questions']) . "!");
    }
}
