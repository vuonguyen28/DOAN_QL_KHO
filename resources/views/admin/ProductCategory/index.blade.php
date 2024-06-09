@extends('admin.layout.app')
@section('title', 'LIST CATEGORY')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Open modal
    </button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>CURD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ProductCategory as $item)
                <tr>
                    <td>{{ $item->MALOAISP }}</td>
                    <td>{{ $item->TENLOAISP }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->MALOAISP }}">
                            Edit
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('category.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $item->MALOAISP }}" name="MALOAISP">
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for adding new category -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="TENLOAISP">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing category -->
    @foreach ($ProductCategory as $item)
        <div class="modal" id="editModal{{ $item->MALOAISP }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('category.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input hidden name="MALOAISP" value="{{ $item->MALOAISP }}">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="TENLOAISP" value="{{ $item->TENLOAISP }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
