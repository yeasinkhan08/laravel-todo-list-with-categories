@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Todo Details
                    <div class="float-end">
                        <span class="badge bg-{{ $todo->is_completed ? 'success' : 'warning' }}">
                            {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $todo->title }}</h4>
                        <p class="text-muted">Created: {{ $todo->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Description:</h5>
                        <p>{{ $todo->description }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary">
                            Edit Todo
                        </a>
                        
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this todo?')">
                                Delete Todo
                            </button>
                        </form>
                        
                        <a href="{{ route('todos.index') }}" class="btn btn-secondary">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
