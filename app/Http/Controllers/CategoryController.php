<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Auth::user()->categories()
            ->withCount('todos')
            ->latest()
            ->paginate(10);
            
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('categories')->where('user_id', Auth::id())
            ]
        ]);

        Auth::user()->categories()->create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category with its todos.
     */
    public function show(Category $category): View
    {
        $todos = $category->todos()
            ->latest()
            ->paginate(10);
            
        return view('categories.show', compact('category', 'todos'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('categories')
                    ->where('user_id', Auth::id())
                    ->ignore($category->id)
            ]
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        
        // Check if category has any todos
        if ($category->todos()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Cannot delete category with existing todos.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
