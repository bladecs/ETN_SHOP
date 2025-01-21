@foreach ($orders_done->groupBy('id_order') as $id_order => $orders)
    @php
        $firstOrder = $orders->first(); // Ambil elemen pertama dari grup
    @endphp
    <tr class="hover:bg-gray-100 border-b border-gray-200">
        <!-- ID Order -->
        <td class="py-3 px-4 text-center" rowspan="{{ $orders->count() }}">{{ $id_order }}</td>

        <!-- Produk -->
        <td class="py-3 px-4 text-center">{{ $firstOrder->id_produk }}</td>

        <!-- Nama Customer -->
        <td class="py-3 px-4 text-center" rowspan="{{ $orders->count() }}">{{ $firstOrder->nama_customer }}</td>

        <!-- Qty -->
        <td class="py-3 px-4 text-center">{{ $firstOrder->qty }}</td>

        <!-- Deadline -->
        <td class="py-3 px-4 text-center">{{ $firstOrder->deadline }}</td>

        <!-- Status -->
        <td class="py-3 px-4 text-center">
            <span
                class="flex px-4 py-2 justify-center text-white rounded-lg
                {{ $firstOrder->status == 'on going' ? 'bg-gray-700' : ($firstOrder->status == 'selesai' ? 'bg-green-500' : 'bg-red-500') }}">
                {{ $firstOrder->status }}
            </span>
        </td>

        <!-- Created At -->
        <td class="py-3 px-4 text-center">{{ $firstOrder->created_at }}</td>

        <!-- Updated At -->
        <td class="py-3 px-4 text-center">{{ $firstOrder->updated_at }}</td>

        <!-- Actions -->
        <td class="py-3 px-4 text-center" rowspan="{{ $orders->count() }}">
            <div class="btn-group flex flex-col gap-1">
                <button type="button"
                    class="updateButton bg-gray-800 text-white py-2 px-4 rounded transition-all duration-300">
                    <a href="{{ route('generate', ['id_order' => $id_order]) }}">Print</a>
                </button>
            </div>
        </td>
    </tr>

    <!-- Semua Data -->
    @foreach ($orders as $index => $order)
        @if ($index > 0) <!-- Cegah duplikasi baris pertama -->
            <tr class="hover:bg-gray-100 border-b border-gray-200">
                <!-- Produk -->
                <td class="py-3 px-4 text-center">{{ $order->id_produk }}</td>

                <!-- Qty -->
                <td class="py-3 px-4 text-center">{{ $order->qty }}</td>

                <!-- Deadline -->
                <td class="py-3 px-4 text-center">{{ $order->deadline }}</td>

                <!-- Status -->
                <td class="py-3 px-4 text-center">
                    <span
                        class="flex px-4 py-2 justify-center text-white rounded-lg
                        {{ $order->status == 'on going' ? 'bg-gray-700' : ($order->status == 'selesai' ? 'bg-green-500' : 'bg-red-500') }}">
                        {{ $order->status }}
                    </span>
                </td>

                <!-- Created At -->
                <td class="py-3 px-4 text-center">{{ $order->created_at }}</td>

                <!-- Updated At -->
                <td class="py-3 px-4 text-center">{{ $order->updated_at }}</td>
            </tr>
        @endif
    @endforeach
@endforeach
