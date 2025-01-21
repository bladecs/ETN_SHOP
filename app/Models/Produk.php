<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = ['nama', 'jenis', 'ukuran','qty'];
    protected $guarded = 'id';
    protected $keyType = 'string';
    public $timestamps = true;
    public function orders()
    {
        return $this->hasMany(Order::class, 'id_produk');
    }
}
