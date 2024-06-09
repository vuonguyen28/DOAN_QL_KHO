<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutReceipt extends Model
{
    use HasFactory;

    protected $table = 'CTPHIEUXUATKHO';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MAXK', 'MASP', 'SLXUATKHO', 'DONGIAKX'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }

    public function receipt()
    {
        return $this->belongsTo(StockOutReceipt::class, 'MAXK', 'MAXK');
    }
}
