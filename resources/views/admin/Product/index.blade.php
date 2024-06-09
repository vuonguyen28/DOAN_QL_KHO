@extends('admin.layout.app')
@section('title', 'LIST Product')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Product
    </button>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>SALE</th>
                <th>Giá bán</th>
                <th>Số Lượng Tồn</th>
                <th>Đơn Vị Tính</th>
                <th>Mã Loại Sản Phẩm</th>
                <th>Mã Nhà Cung Cấp</th>
                <th>Mã Kho</th>
                <th>Hình Sản Phẩm</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->MASP }}</td>
                    <td>{{ $product->TENSP }}</td>
                    <td>{{ $product->MUCCHUYENMAI }}</td>
                    <td>{{ $product->DONGIABAN }}</td>
                    <td>{{ $product->SLTON }}</td>
                    <td>{{ $product->DOVINHTINH }}</td>
                    <td>{{ $product->category->TENLOAISP }}</td>
                    <td>{{ $product->supplier->TENNCC }}</td>
                    <td>{{ $product->warehouse->TENKHO }}</td>
                    <td>
                        @if($product->HinhSP)
                            <img src="{{ asset($product->HinhSP) }}" alt="{{ $product->TENSP }}" class="img-thumbnail" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $product->MASP }}">
                            Edit
                        </button>
                        <form action="{{ route('product.destroy') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" value="{{ $product->MASP }}" name="MASP">
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for adding new Product -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel">Add New Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="TENSP" required>
                        </div>
                        <div class="mb-3">
                            <label for="sale" class="form-label">MUCCHUYENMAI</label>
                            <input type="text" class="form-control" id="sale" name="MUCCHUYENMAI" required>
                        </div>
                        <div class="mb-3">
                            <label for="dongiaban" class="form-label">Giá Bán</label>
                            <input type="text" class="form-control" id="dongiaban" name="DONGIABAN" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số Lượng Tồn</label>
                            <input type="text" class="form-control" id="quantity" name="SLTON" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit" class="form-label">Đơn Vị Tính</label>
                            <input type="text" class="form-control" id="unit" name="DOVINHTINH" required>
                        </div>
                        <div class="mb-3">
                            <label for="hinhsp" class="form-label">Hình Sản Phẩm</label>
                            <input type="file" class="form-control" id="hinhsp" name="HinhSP">
                        </div>
                        <div class="form-group mb-3">
                            <label for="supplier">Nhà Cung Cấp</label>
                            <select name="MANCC" id="supplier" class="form-control" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->MANCC }}">{{ $supplier->TENNCC }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="warehouse">Kho</label>
                            <select name="MAKHO" id="warehouse" class="form-control" required>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->MAKHO }}">{{ $warehouse->TENKHO }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Danh Mục Sản Phẩm</label>
                            <select name="MALOAISP" id="category" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->MALOAISP }}">{{ $category->TENLOAISP }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing Product -->
    @foreach ($products as $product)
        <div class="modal fade" id="editModal{{ $product->MASP }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel{{ $product->MASP }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel{{ $product->MASP }}">Edit Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="MASP" value="{{ $product->MASP }}">
                            <div class="mb-3">
                                <label for="product_name_{{ $product->MASP }}" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name_{{ $product->MASP }}"
                                    name="TENSP" value="{{ $product->TENSP }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mucchuyenmai_{{ $product->MASP }}" class="form-label">MUCCHUYENMAI</label>
                                <input type="text" class="form-control" id="mucchuyenmai_{{ $product->MASP }}"
                                    name="MUCCHUYENMAI" value="{{ $product->MUCCHUYENMAI }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="dongiaban_{{ $product->MASP }}" class="form-label">Giá bán</label>
                                <input type="text" class="form-control" id="dongiaban_{{ $product->MASP }}"
                                    name="DONGIABAN" value="{{ $product->DONGIABAN }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity_{{ $product->MASP }}" class="form-label">Số Lượng Tồn</label>
                                <input type="text" class="form-control" id="quantity_{{ $product->MASP }}"
                                    name="SLTON" value="{{ $product->SLTON }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="unit_{{ $product->MASP }}" class="form-label">Đơn Vị Tính</label>
                                <input type="text" class="form-control" id="unit_{{ $product->MASP }}"
                                    name="DOVINHTINH" value="{{ $product->DOVINHTINH }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="hinhsp_{{ $product->MASP }}" class="form-label">Hình Sản Phẩm</label>
                                <input type="file" class="form-control" id="hinhsp_{{ $product->MASP }}" name="HinhSP">
                                @if($product->HinhSP)
                                    <img src="{{ asset( $product->HinhSP) }}" alt="{{ $product->TENSP }}" class="img-thumbnail mt-2" width="100">
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="supplier_{{ $product->MASP }}">Nhà Cung Cấp</label>
                                <select name="MANCC" id="supplier_{{ $product->MASP }}" class="form-control" required>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->MANCC }}"
                                            {{ $supplier->MANCC == $product->MANCC ? 'selected' : '' }}>
                                            {{ $supplier->TENNCC }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="warehouse_{{ $product->MASP }}">Kho</label>
                                <select name="MAKHO" id="warehouse_{{ $product->MASP }}" class="form-control" required>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->MAKHO }}"
                                            {{ $warehouse->MAKHO == $product->MAKHO ? 'selected' : '' }}>
                                            {{ $warehouse->TENKHO }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="category_{{ $product->MASP }}">Danh Mục Sản Phẩm</label>
                                <select name="MALOAISP" id="category_{{ $product->MASP }}" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->MALOAISP }}"
                                            {{ $category->MALOAISP == $product->MALOAISP ? 'selected' : '' }}>
                                            {{ $category->TENLOAISP }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
