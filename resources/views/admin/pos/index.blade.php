<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    @foreach ($categories as $item)
        <form action="{{ route('pos.index') }}" method="POST">
            @csrf
            <input type="hidden" name="MALOAISP" value="{{ $item->MALOAISP }}">
            <button class="btn btn-danger">{{ $item->TENLOAISP }}</button>
        </form>
    @endforeach

    <form action="{{ route('pos.index') }}" method="POST">
        @csrf
        <input type="search" name="search" value="">
        <button class="btn btn-danger" type="submit">Search</button>
    </form>
    
    <table class="table table-hover" style="width:700px">
        <thead>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>SALE</th>
                <th>Giá bán</th>
                <th>Số Lượng Tồn</th>
                <th>Đơn Vị Tính</th>
                <th>Hình Sản Phẩm</th>
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
                    <td>
                        @if ($product->HinhSP)
                            <img src="{{ asset($product->HinhSP) }}" alt="{{ $product->TENSP }}" class="img-thumbnail"
                                width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('pos.addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="MASP" value="{{ $product->MASP }}">
                            <button type="submit" class="btn btn-secondary">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($cart)
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $productId => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Giỏ hàng của bạn đang trống</p>
    @endif

    <button class="btn btn-success">Tong tien la: {{ $totalPrice }}</button>
</body>

</html>
