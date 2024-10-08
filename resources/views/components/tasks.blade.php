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
