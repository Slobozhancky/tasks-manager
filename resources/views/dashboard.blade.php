@extends('layouts.main')

@section('dashboard')
    @if(session('success') and session('role'))
        <div class="alert alert-secondary" role="alert">
            <p>Hello, {{ session('success') }}</p>
            <p>Your role: {{ session('role') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @section('dashboard')
            <h2 class="text-center">Tasks Kanban Board</h2>

            <div class="row" style="width: 100%">
                <div class="col-2">
                    <div class="sidebar bg-light p-3">
                        <h5 class="mb-3">Categories</h5>

                        <div class="mt-3 mb-2">
                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#newCategoryModal">
                                + New Category
                            </button>
                        </div>

                        <ul class="list-group">
                            @foreach($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $category->title }}
                                    <span class="badge badge-primary badge-pill">{{ $category->tasks_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="modal fade" id="newCategoryModal" tabindex="-1" aria-labelledby="newCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newCategoryModalLabel">Create New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form for creating a new category -->
                                    <form action="{{ route('categories.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="categoryTitle" class="form-label">Category Title</label>
                                            <input type="text" class="form-control" id="categoryTitle" name="title" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Create Category</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10">
                    <div class="row">
                        @foreach($tasks as $task)
                            <div class="col-2 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">{{ $task->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Category: {{ $task->category->title }}</h6>
                                        <p class="card-text">{{ $task->description }}</p>

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <strong>Status:</strong>
                                                <span class="badge
                    @if($task->status === 'pending') bg-warning
                    @elseif($task->status === 'in_progress') bg-info
                    @elseif($task->status === 'completed') bg-success
                    @elseif($task->status === 'canceled') bg-danger
                    @endif">
                    {{ ucfirst($task->status) }}
                </span>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success rounded-circle position-fixed" style="width: 50px; border: none; height: 50px; bottom: 30px; right: 30px; background-color: transparent" data-bs-toggle="modal" data-bs-target="#taskModal">
            <img src="{{ asset('images/icons/plus.ico') }}" width="40px" alt="plus" srcset="">
        </button>

        <!-- Modal for creating task -->
        <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Create Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Dedline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection


@endsection
