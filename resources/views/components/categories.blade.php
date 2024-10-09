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
            <li class="list-group-item d-flex justify-content-between align-items-center category-item">
                {{ $category->title }}
                <span class="badge badge-primary badge-pill">{{ $category->tasks_count }}</span>

                <div class="card-footer d-flex justify-content-between" style="visibility: hidden;">
                    <!-- Кнопка для відкриття модального вікна редагування -->
                    <button class="btn btn-sm btn-primary p-1" data-bs-toggle="modal" style="background: none; border: none; color: inherit; cursor: pointer;"
                            data-bs-target="#editCategoryModal-{{ $category->id }}">
                        <img src="{{ asset('images/icons/edit.ico') }}" alt="edit" style="width: 20px">
                    </button>

                    <!-- Кнопка для відкриття модального вікна видалення -->
                    <button class="btn btn-sm btn-danger p-1" data-bs-toggle="modal" style="background: none; border: none; color: inherit; cursor: pointer;"
                            data-bs-target="#deleteCategoryModal-{{ $category->id }}">
                        <img src="{{ asset('images/icons/delete.ico') }}" alt="delete" style="width: 20px">
                    </button>
                </div>
            </li>

            <!-- Modal для редагування категорії -->
            <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1"
                 aria-labelledby="editCategoryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="category_id" id="editCategoryId" value="{{ $category->id }}">
                                <div class="mb-3">
                                    <label for="editCategoryTitle" class="form-label">Category Title</label>
                                    <input type="text" class="form-control" id="editCategoryTitle" name="title"
                                           value="{{ $category->title }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Модальне вікно для підтвердження видалення категорії -->
            <div class="modal fade" id="deleteCategoryModal-{{ $category->id }}" tabindex="-1"
                 aria-labelledby="deleteCategoryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCategoryLabel">Delete Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete the category <strong>{{ $category->title }}</strong>?</p>
                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
