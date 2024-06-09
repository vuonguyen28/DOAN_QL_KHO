<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'LOAISANPHAM';
    protected $primaryKey = 'MALOAISP';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'MALOAISP', 'TENLOAISP'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'MALOAISP', 'MALOAISP');
    }
}
