<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'HOADON';
    protected $primaryKey = 'MAHD';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MAHD', 'NGAYLAPHD', 'PTTT', 'MANV', 'MAKH'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'MANV', 'MANV');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'MAKH', 'MAKH');
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'MAHD', 'MAHD');
    }
}
