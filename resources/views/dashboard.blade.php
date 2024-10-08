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
                <x-categories :categories="$categories"/>
            </div>

            <div class="col-10">
                <div class="row">
                    <x-tasks :tasks="$tasks" :categories="$categories" :statuses="$statuses"/>
                    <x-create_tasks :statuses="$statuses" :categories="$categories"/>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success rounded-circle position-fixed"
                style="width: 50px; border: none; height: 50px; bottom: 30px; right: 30px; background-color: transparent"
                data-bs-toggle="modal" data-bs-target="#taskModal">
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
                                <textarea type="text" class="form-control" id="description" name="description"
                                          required></textarea>
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
