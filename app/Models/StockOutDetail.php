<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutDetail extends Model
{
    use HasFactory;

    protected $table = 'CTPHIEUXUATKHO';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MAXK', 'MASP', 'SLXUATKHO', 'DONGIAKX'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }

    public function stockOutReceipt()
    {
        return $this->belongsTo(StockOutReceipt::class, 'MAXK', 'MAXK');
    }
}
