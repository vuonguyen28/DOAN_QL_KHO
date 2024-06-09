@extends('admin.layout.app')

@section('title', 'Employee Management')

@section('content')
    <!-- Button trigger modal for adding new employee -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Employee
    </button>

    <!-- Table to display list of employees -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->MANV }}</td>
                    <td>{{ $employee->HONV }}</td>
                    <td>{{ $employee->TENNV }}</td>
                    <td>{{ $employee->NGAYSINH }}</td>
                    <td>{{ $employee->GIOITINH }}</td>
                    <td>{{ $employee->CHUCVU }}</td>
                    <td>{{ $employee->DIACHI }}</td>
                    <td>{{ $employee->DIENTHOAI }}</td>
                    <td>{{ $employee->EMAIL }}</td>
                    <td>
                        <!-- Button trigger modal for editing employee -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $employee->MANV }}">
                            Edit
                        </button>

                        <!-- Form for deleting employee -->
                        <form action="{{ route('employee.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $employee->MANV }}" name="MANV">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for adding new employee -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Employee</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to add new employee -->
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="HONV">
                        </div>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="TENNV">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="NGAYSINH">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="GIOITINH">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="CHUCVU">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="DIACHI">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="DIENTHOAI">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="EMAIL">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @foreach ($employees as $employee)
        <div class="modal" id="editModal{{ $employee->MANV }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to edit employee -->
                        <form action="{{ route('employee.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="MANV" value="{{ $employee->MANV }}">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="HONV"
                                    value="{{ $employee->HONV }}">
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="TENNV"
                                    value="{{ $employee->TENNV }}">
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="NGAYSINH"
                                    value="{{ $employee->NGAYSINH }}">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="GIOITINH">
                                    <option value="Male" {{ $employee->GIOITINH == 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ $employee->GIOITINH == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="CHUCVU"
                                    value="{{ $employee->CHUCVU }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="DIACHI"
                                    value="{{ $employee->DIACHI }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="DIENTHOAI"
                                    value="{{ $employee->DIENTHOAI }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="EMAIL"
                                    value="{{ $employee->EMAIL }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
