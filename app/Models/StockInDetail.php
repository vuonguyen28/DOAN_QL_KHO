<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInDetail extends Model
{
    use HasFactory;

    protected $table = 'CTPHIEUNHAPKHO';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MANK', 'MASP', 'SLNHAPKHO', 'DONGIANK'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }

    public function stockInReceipt()
    {
        return $this->belongsTo(StockInReceipt::class, 'MANK', 'MANK');
    }
}
