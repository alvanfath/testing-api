<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    use HasFactory;
    protected $table = 'list';
    protected $fillable = [
        'nama_produk',
        'jenis_produk',
        'is_active',
        'harga'
    ];
}
