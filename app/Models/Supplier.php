<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'NHACUNGCAP';
    protected $primaryKey = 'MANCC';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MANCC', 'TENNCC', 'DIACHI', 'EMAIL'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'MANCC', 'MANCC');
    }
}
