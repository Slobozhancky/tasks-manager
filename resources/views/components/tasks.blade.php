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
                <!-- Кнопка для відкриття модального вікна редагування -->
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#editTaskModal-{{ $task->id }}">
                    Edit
                </button>

                <!-- Кнопка для відкриття модального вікна видалення -->
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteTaskModal-{{ $task->id }}">
                    Delete
                </button>
            </div>

            <!-- Modal для редагування таски -->
            <div class="modal fade" id="editTaskModal-{{ $task->id }}" tabindex="-1"
                 aria-labelledby="editTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{ $task->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-control" id="category" name="category_id" required>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                              required>{{ $task->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Deadline</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline"
                                           value="{{ $task->deadline }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal для підтвердження видалення -->
            <div class="modal fade" id="deleteTaskModal-{{ $task->id }}" tabindex="-1"
                 aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteTaskModalLabel">Delete Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this task?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach
