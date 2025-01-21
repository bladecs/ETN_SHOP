<div class="overflow-x-scroll">
    <table id="orders_done" class="table-auto w-full bg-white shadow-lg rounded-lg overflow-scroll">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-center">Order ID</th>
                <th class="py-3 px-4 text-center">ID Produk</th>
                <th class="py-3 px-4 text-center">Nama Customer</th>
                <th class="py-3 px-4 text-center">QTY</th>
                <th class="py-3 px-4 text-center">Deadline</th>
                <th class="py-3 px-4 text-center">Status</th>
                <th class="py-3 px-4 text-center">Di Buat</th>
                <th class="py-3 px-4 text-center">Di Update</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @include('partials.table_done')
        </tbody>
    </table>
</div>
<!-- Custom Pagination -->
@include('partials.pagination_done')
