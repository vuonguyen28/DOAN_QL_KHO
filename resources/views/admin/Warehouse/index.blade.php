@extends('admin.layout.app')
@section('title', 'LIST WAREHOUSE')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Warehouse
    </button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Warehouse Name</th>
                <th>Address</th>
                <th>CURD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->MAKHO }}</td>
                    <td>{{ $warehouse->TENKHO }}</td>
                    <td>{{ $warehouse->DIACHI }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $warehouse->MAKHO }}">
                            Edit
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('warehouse.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $warehouse->MAKHO }}" name="MAKHO">
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for adding new warehouse -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Warehouse</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('warehouse.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="warehouse_name" class="form-label">Warehouse Name</label>
                            <input type="text" class="form-control" id="warehouse_name" name="TENKHO">
                        </div>
                        <div class="mb-3">
                            <label for="warehouse_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="warehouse_address" name="DIACHI">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing warehouse -->
    @foreach ($warehouses as $warehouse)
        <div class="modal" id="editModal{{ $warehouse->MAKHO }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Warehouse</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('warehouse.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input hidden name="MAKHO" value="{{ $warehouse->MAKHO }}">
                                <label for="warehouse_name" class="form-label">Warehouse Name</label>
                                <input type="text" class="form-control" id="warehouse_name" name="TENKHO" value="{{ $warehouse->TENKHO }}">
                            </div>
                            <div class="mb-3">
                                <label for="warehouse_address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="warehouse_address" name="DIACHI" value="{{ $warehouse->DIACHI }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
