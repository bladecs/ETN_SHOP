<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function getOrders()
    {
        // Cek apakah ada order yang sedang 'on going'
        $ongoingOrder = Order::where('status', 'on going')->first();

        // Jika tidak ada order 'on going', ambil order 'pending' dengan deadline terdekat
        if (!$ongoingOrder) {
            $order = Order::where('status', 'pending')
                ->orderBy('deadline', 'ASC')
                ->first();

            // Jika ada order, ubah status menjadi 'on going'
            if ($order) {
                $order->status = 'on going';
                $order->save();
            }
        }

        // Ambil semua order setelah perubahan status
        $orders = Order::selectRaw('DATE(deadline) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        return response()->json($orders);
    }
    public function generatePDF($id_order)
    {
        $orders = Order::join('produk', 'order.id_produk', '=', 'produk.id')
            ->where('order.id_order', $id_order)
            ->select('order.*', 'produk.nama')
            ->get();

        $pdf = Pdf::loadView('template.pdf.order_pdf', compact('orders'));

        return $pdf->download('order-' . $id_order . '.pdf');
    }
}
