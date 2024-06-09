<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'KHO';
    protected $primaryKey = 'MAKHO';
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'MAKHO', 'TENKHO', 'DIACHI'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'MAKHO', 'MAKHO');
    }
}
