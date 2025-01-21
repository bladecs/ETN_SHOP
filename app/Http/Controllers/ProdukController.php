<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan produk beserta jumlah pesanan
        $produk = Produk::withCount('orders')->get();

        // Mengambil data pesanan yang belum selesai dan yang sudah selesai
        $orders_data = Order::where('status', '<>', 'selesai')->get();
        $orders_data_done = Order::where('status', '=', 'selesai')->get();

        // Menggunakan Carbon untuk menghitung sisa waktu dan mengurutkan berdasarkan waktu terdekat menuju deadline
        $order_ongoing = $orders_data->sortByDesc(function ($order) {
            return Carbon::parse($order->deadline)->diffInSeconds(Carbon::now());
        });

        $order_done = $orders_data_done->sortByDesc(function ($order) {
            return Carbon::parse($order->deadline)->diffInSeconds(Carbon::now());
        });

        $orders = new \Illuminate\Pagination\LengthAwarePaginator(
            $order_ongoing->forPage($request->page ?? 1, 5),
            $order_ongoing->count(),
            5,
            $request->page ?? 1
        );

        $orders_done = new \Illuminate\Pagination\LengthAwarePaginator(
            $order_done->forPage($request->page_done ?? 1, 5),
            $order_done->count(),
            5,
            $request->page_done ?? 1
        );

        if ($request->ajax()) {
            if ($request->has('page_done')) {
                // Return data untuk tabel done
                return response()->json([
                    'html' => view('partials.table_done', ['orders_done' => $orders_done])->render(),
                    'pagination' => view('partials.pagination_done', ['currentPage_done' => $orders_done->currentPage(), 'totalPages_done' => $orders_done->lastPage()])->render(),
                ]);
            } else {
                // Return data untuk tabel ongoing
                return response()->json([
                    'html' => view('partials.table_ongoing', ['orders' => $orders])->render(),
                    'pagination' => view('partials.pagination_ongoing', ['currentPage' => $orders->currentPage(), 'totalPages' => $orders->lastPage()])->render(),
                ]);
            }
        }

        // Mengirim variabel yang tepat ke view
        return view('dashboard_page.dashboard', [
            'produk' => $produk,
            'orders' => $orders,
            'orders_done' => $orders_done,
            'currentPage' => $orders->currentPage(),
            'totalPages' => $orders->lastPage(),
            'currentPage_done' => $orders_done->currentPage(),
            'totalPages_done' => $orders_done->lastPage(),
        ]);
    }

    public function getStock($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            return response()->json(['stock' => $produk->qty]);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }
    public function fetch()
    {
        $produk = Produk::withCount('orders')->get();
        return response()->json($produk)->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
    public function create(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string',
            'id_produk' => 'required|array|min:1',
            'id_produk.*' => 'required|string|exists:produk,id',
            'qty' => 'required|array|min:1',
            'qty.*' => 'required|integer|min:1',
            'deadline' => 'required|array|min:1',
            'deadline.*' => 'required|date',
        ], [
            'nama_customer.required' => 'Nama wajib diisi',
            'id_produk.required' => 'ID Produk wajib diisi.',
            'qty.required' => 'Jumlah Produk wajib diisi.',
            'deadline.required' => 'Deadline wajib diisi.',
        ]);

        try {
            // Generate ID Order
            $orderId = Order::generateOrderId();
            // Loop untuk menyimpan setiap produk dalam satu order
            foreach ($request->id_produk as $index => $id_produk) {
                Order::create([
                    'id' => uniqid(), // ID unik untuk setiap produk dalam satu order
                    'id_order' => $orderId,
                    'id_produk' => $id_produk,
                    'nama_customer' => $request->nama_customer,
                    'qty' => $request->qty[$index],
                    'deadline' => $request->deadline[$index],
                ]);
            }
            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Log error dan kembalikan pesan ramah pengguna
            Log::error('Error creating order: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan produk. Silakan coba lagi.']);
        }
    }
    public function orderReady(Request $request)
    {
        $validated = $request->validate([
            'id_order' => 'required|exists:order,id_order',
            'id_produk' => 'required|exists:produk,id',
            'qty' => 'required|integer|min:1',
            'deadline' => 'required|date',
        ]);

        // Ambil order dan produk berdasarkan ID
        $order = Order::where('id_order', $request->id_order)
            ->where('status', 'on going')
            ->first();

        $product = Produk::where('id', $request->id_produk)->first();

        // Pastikan order dan produk ditemukan
        if (!$order || !$product) {
            return redirect()->back()->withErrors(['message' => 'Order atau produk tidak ditemukan.']);
        }

        // Cek jika stok produk tidak cukup
        if ($product->qty < $request->qty) {
            $order->qty = $product->qty; // Sesuaikan order dengan stok yang tersedia
            $product->qty = 0; // Kosongkan stok produk
            $product->save();
            $order->save(); // Simpan perubahan pada order
        } else {
            // Kurangi stok produk sesuai dengan qty pesanan
            $product->qty -= $request->qty;
            $order->status = "selesai";
            $order->save();
            $product->save();
        }

        // Update data order
        $order->update([
            'qty' => $request->qty,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('produk.index')->with('success', 'Order berhasil diperbarui dan stok produk diperbarui.');
    }
}
