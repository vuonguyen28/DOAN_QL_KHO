<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'NHANVIEN';
    protected $primaryKey = 'MANV';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MANV', 'HONV', 'TENNV', 'NGAYSINH', 'GIOITINH', 'CHUCVU', 'DIACHI', 'DIENTHOAI', 'EMAIL'
    ];
}
