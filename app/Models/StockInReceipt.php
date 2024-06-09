<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInReceipt extends Model
{
    use HasFactory;

    protected $table = 'PHIEUNHAPKHO';
    protected $primaryKey = 'MANK';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MANK', 'NGAYNHAP', 'MANV'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'MANV', 'MANV');
    }

    public function details()
    {
        return $this->hasMany(StockInDetail::class, 'MANK', 'MANK');
    }
}
