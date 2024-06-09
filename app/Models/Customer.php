<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'KHACHHANG';
    protected $primaryKey = 'MAKH';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MAKH', 'HOTENKH', 'TENKH', 'DIACHI', 'DIENTHOAI'
    ];
}
