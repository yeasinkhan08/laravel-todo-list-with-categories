<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Auth::user()->todos()->with('category')->latest()->paginate(10);
        $categories = Auth::user()->categories;
        return view('todos.index', compact('todos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Auth::user()->categories;
        return view('todos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id,user_id,' . Auth::id(),
            'due_date' => 'nullable|date',
            'is_completed' => 'boolean',
        ]);

        Auth::user()->todos()->create($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Todo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);
        $categories = Auth::user()->categories;
        return view('todos.edit', compact('todo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id,user_id,' . Auth::id(),
            'due_date' => 'nullable|date',
            'is_completed' => 'boolean',
        ]);

        $todo->update($validated);

        return redirect()->route('todos.index')
            ->with('success', 'Todo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();
        
        return redirect()->route('todos.index')
            ->with('success', 'Todo deleted successfully.');
    }

    /**
     * Toggle the completion status of the specified todo.
     */
    public function toggle(Todo $todo)
    {
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);
        
        return redirect()->back()->with('success', 'Todo updated successfully');
    }
}
