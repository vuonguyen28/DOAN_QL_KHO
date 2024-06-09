<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'SANPHAM';
    protected $primaryKey = 'MASP';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MASP', 'TENSP', 'MUCCHUYENMAI', 'DONGIABAN', 'SLTON', 'DOVINHTINH', 'MALOAISP', 'MANCC', 'MAKHO','HinhSP'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'MALOAISP', 'MALOAISP');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'MANCC', 'MANCC');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'MAKHO', 'MAKHO');
    }

    public function stockOutDetails()
    {
        return $this->hasMany(StockOutDetail::class, 'MASP', 'MASP');
    }

    public function stockInDetails()
    {
        return $this->hasMany(StockInDetail::class, 'MASP', 'MASP');
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'MASP', 'MASP');
    }
}
