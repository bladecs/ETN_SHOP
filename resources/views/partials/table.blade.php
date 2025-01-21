@foreach ($orders as $order)
    <tr class="hover:bg-gray-100 border-b border-gray-200">
        <td class="py-3 px-4 text-center">{{ $order->id_order }}</td>
        <td class="py-3 px-4 text-center">{{ $order->id_produk }}</td>
        <td class="py-3 px-4 text-center">{{ $order->nama_customer }}</td>
        <td class="py-3 px-4 text-center">{{ $order->qty }}</td>
        <td class="py-3 px-4 text-center">{{ $order->deadline }}</td>
        <td class="py-3 px-4 text-center">
            <span class="timer" data-deadline="{{ $order->deadline }}"></span>
        </td>
        <td class="py-3 px-4 text-center">
            <span
                class="flex px-4 py-2 justify-center text-white rounded-lg {{ $order->status == 'on going' ? 'bg-gray-700' : ($order->status == 'selesai' ? 'bg-green-500' : ($order->status == 'pending' ? 'bg-red-500' : '')) }}">
                {{ $order->status }}
            </span>
        </td>
        <td class="py-3 px-4 text-center">{{ $order->created_at }}</td>
        <td class="py-3 px-4 text-center">{{ $order->updated_at }}</td>
        <td>
            <div class="btn-group flex flex-col gap-1">
                <button type="button" data-id="{{ $order->id }}" data-id-order="{{ $order->id_order }}"
                    data-produk="{{ $order->id_produk }}" data-qty="{{ $order->qty }}"
                    data-time="{{ $order->deadline }}"
                    class="updateButton bg-gray-800 text-white py-2 px-4 rounded transition-all duration-300">Update</button>
                <button type="button" data-id="{{ $order->id }}"
                    class="deleteButton bg-gray-600 text-white py-2 px-4 rounded transition-all duration-300">Delete</button>
            </div>
        </td>
    </tr>
@endforeach
