<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'CTHOADON';
    protected $primaryKey = null;
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'MAHD', 'MASP', 'SLBAN', 'DONGIABAN'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'MAHD', 'MAHD');
    }
}
