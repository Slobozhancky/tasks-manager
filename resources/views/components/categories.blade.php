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
