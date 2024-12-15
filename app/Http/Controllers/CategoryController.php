<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Load categories from your data source (e.g., QuizData.php)
        $categories = collect(require app_path('Data/QuizData.php'))->get('categories');

        // Pass categories to the view
        return view('quiz.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $categories = collect(require app_path('Data/QuizData.php'))->get('categories');
        $newId = collect($categories)->max('id') + 1;

        $newCategory = [
            'id' => $newId,
            'name' => $request->input('name'),
            'quizzes' => [],
        ];

        $categories[] = $newCategory;

        file_put_contents(
            app_path('Data/QuizData.php'),
            '<?php return ' . var_export(['categories' => $categories], true) . ';'
        );

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $categories = collect(require app_path('Data/QuizData.php'))->get('categories');
        $category = collect($categories)->firstWhere('id', $id);

        if (!$category) {
            abort(404, 'Category not found.');
        }

        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $categories = collect(require app_path('Data/QuizData.php'))->get('categories');

        foreach ($categories as &$category) {
            if ($category['id'] == $id) {
                $category['name'] = $request->input('name');
            }
        }

        file_put_contents(
            app_path('Data/QuizData.php'),
            '<?php return ' . var_export(['categories' => $categories], true) . ';'
        );

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $categories = collect(require app_path('Data/QuizData.php'))->get('categories');

        $categories = collect($categories)->reject(function ($category) use ($id) {
            return $category['id'] == $id;
        })->values()->all();

        file_put_contents(
            app_path('Data/QuizData.php'),
            '<?php return ' . var_export(['categories' => $categories], true) . ';'
        );

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
