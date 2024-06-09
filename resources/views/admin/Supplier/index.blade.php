@extends('admin.layout.app')
@section('title', 'LIST SUPPLIER')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Open modal
    </button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>CURD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier) 
                <tr>
                    <td>{{ $supplier->MANCC }}</td> 
                    <td>{{ $supplier->TENNCC }}</td> 
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $supplier->MANCC }}">
                            Edit
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('supplier.destroy') }}" method="POST"> 
                            @csrf
                            <input type="hidden" value="{{ $supplier->MANCC }}" name="MANCC"> 
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for adding new supplier -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Supplier</h4> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.store') }}" method="POST"> 
                        @csrf
                        <div class="mb-3">
                            <label for="supplier_name" class="form-label">Supplier Name</label> 
                            <input type="text" class="form-control" id="supplier_name" name="TENNCC"> 
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($suppliers as $supplier)
    <div class="modal" id="editModal{{ $supplier->MANCC }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Supplier</h4> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input hidden name="MANCC" value="{{ $supplier->MANCC }}"> 
                            <label for="supplier_name" class="form-label">Supplier Name</label>
                            <input type="text" class="form-control" id="supplier_name" name="TENNCC" value="{{ $supplier->TENNCC }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
