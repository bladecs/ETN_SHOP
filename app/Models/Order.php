<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order'; // pastikan tabel menggunakan nama yang sesuai
    protected $fillable = ['id', 'id_produk', 'id_order', 'qty', 'deadline', 'status', 'sisa_waktu', 'nama_customer']; // 'id' dimasukkan dalam fillable
    protected $guarded = []; // Tidak ada kolom yang dijaga untuk model ini
    protected $keyType = 'string'; // ID bertipe string
    public $incrementing = false; // Nonaktifkan auto-increment untuk kolom id
    public $timestamps = true;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public static function generateOrderId()
    {
        // Ambil order terakhir berdasarkan kolom 'id_order'
        $lastOrder = self::latest('id_order')->first();

        if ($lastOrder && $lastOrder->id_order) {
            // Ambil nomor urut dari ID terakhir (misalnya: OR-001)
            $lastOrderNumber = (int) substr($lastOrder->id_order, 3); // Ambil angka setelah 'OR-'
            $nextOrderNumber = str_pad($lastOrderNumber + 1, 3, '0', STR_PAD_LEFT); // Tambah dan format ke tiga digit
        } else {
            $nextOrderNumber = '001'; // Jika belum ada order, mulai dari 001
        }

        return 'OR-' . $nextOrderNumber; // Kembalikan ID baru
    }
}
