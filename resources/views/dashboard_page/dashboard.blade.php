<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWHf3jfanhudIWv5L7dT1uhA6sRYpzuOY&callback=console.debug&libraries=maps,marker&v=beta">
    </script>

</head>

<body>
    <div class="flex flex-col h-auto">
        @include('template.sidebar')

        <!-- Main Content -->
        <div class="min-h-full h-auto flex-1 ml-48 p-8 space-y-6 transition-all duration-300 bg-slate-100" id="content">
            @if (session('success'))
                <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section id="product">
                <div class="w-full rounded-lg overflow-hidden shadow-lg p-4 bg-white">
                    <div class="py-4">
                        <h2 class="font-bold text-xl mb-2">Our Product</h2>
                        <p class="text-gray-700 text-base">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae
                            vestibulum.
                        </p>
                    </div>
                    <div
                        class="w-full flex flex-col sm:flex-row justify-between rounded-lg space-y-4 sm:space-y-0 sm:space-x-4">
                        <input type="search" name="search_produk" id="search_produk" placeholder="Search Produk"
                            class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none" />
                    </div>
                    <div id="produk-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 py-6">
                        <!-- Card Product -->
                    </div>
                </div>
            </section>

            <section id="calendars">
                <div class="w-full rounded-lg overflow-hidden shadow-lg p-4 bg-white">
                    <div class="py-4">
                        <h2 class="font-bold text-xl mb-2">Calendar Project</h2>
                        <p class="text-gray-700 text-base">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae
                            vestibulum.
                        </p>
                    </div>
                    <div class="flex space-x-4 mb-4 justify-end">
                        <h2 class="font-medium content-center">Filter By : </h2>
                        <button id="dayButton"
                            class="p-2 rounded-md border border-gray-300 w-32 hover:bg-gray-800 hover:text-white transition-all duration-300"
                            onclick="changeCalendarView('day')">
                            Day
                        </button>
                        <button id="weekButton"
                            class="p-2 rounded-md border border-gray-300 w-32 hover:bg-gray-800 hover:text-white transition-all duration-300"
                            onclick="changeCalendarView('week')">
                            Week
                        </button>
                        <button id="monthButton"
                            class="p-2 rounded-md border border-gray-300 w-32 hover:bg-gray-800 hover:text-white transition-all duration-300"
                            onclick="changeCalendarView('month')">
                            Month
                        </button>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <button id="prevButton" class="p-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            onclick="changeMonth(-1)">Previous</button>
                        <h3 id="currentMonth" class="text-xl font-bold"></h3>
                        <button id="nextButton" class="p-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            onclick="changeMonth(1)">Next</button>
                    </div>
                    <div id="calendar" class="bg-gray-800 shadow-lg rounded-lg p-4 w-100"></div>
                </div>
            </section>
            <section id="orders">
                <div class="w-full overflow-hidden rounded-lg shadow-lg p-4 bg-white">
                    <div id="ordersTable" class="py-4 gap-2">
                        <h2 class="font-bold text-xl mb-2">Orders Table</h2>
                        <p class="text-gray-700 text-base">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae
                            vestibulum.
                        </p>
                        <div class="w-full flex justify-end mb-4">
                            <button
                                class="orderButton flex flex-row items-center bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-600 transition-all duration-300">
                                <span class="material-icons">add_shopping_cart</span>
                                <p>Add Order</p>
                            </button>
                        </div>
                        <div class="flex flex-col space-y-10">
                            <div id="ordersContainer">
                                @include('partials.orders_table')
                            </div>
                            <div>
                                @include('partials.orders_table_done')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Modal Input Order -->
        <div id="orderModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 hidden">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl w-full max-w-lg">
                    <form action="{{ route('produk.create') }}" method="POST">
                        @csrf
                        <div id="orderContainer"
                            class="bg-white px-4 pb-4 pt-5 flex flex-col space-y-4 max-h-[70vh] overflow-y-auto">
                            <!-- Order Input Template -->
                            <div class="order-input-group space-y-3">
                                <div class="w-full">
                                    <label for="nama_customer" class="block text-sm font-medium text-gray-700">Nama
                                        Customer</label>
                                    <input type="text" name="nama_customer" id="nama_customer"
                                        placeholder="Masukan nama customer"
                                        class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500" />
                                </div>
                                <div class="w-full">
                                    <label for="id_produk" class="block text-sm font-medium text-gray-700">Nama
                                        Produk</label>
                                    <select name="id_produk[]" id="id_produk"
                                        class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        <option value="">Pilih Produk</option>
                                        <!-- Produk dari database -->
                                        @foreach ($produk as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full">
                                    <label for="qty"
                                        class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" name="qty[]" id="qty"
                                        placeholder="Masukan jumlah produk"
                                        class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500" />
                                </div>
                                <div class="w-full">
                                    <label for="deadline"
                                        class="block text-sm font-medium text-gray-700">Deadline</label>
                                    <input type="date" name="deadline[]" id="deadline"
                                        class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500" />
                                </div>
                                <button type="button"
                                    class="remove-order-btn mt-2 text-red-500 text-sm">Remove</button>
                            </div>
                        </div>
                        <div class="w-full p-4">
                            <button type="button" id="addOrderBtn"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-600">Add
                                Order+</button>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-900 sm:mt-0 sm:w-auto">Submit</button>
                            <button type="button" id="cancelBtn"
                                class="mt-3 mx-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Update Order -->
        <div id="updateModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 hidden">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl w-full max-w-lg">
                    <form action="{{ route('produk.ready') }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pb-4 pt-5 flex flex-col space-y-4">
                            <input type="text" name="id" id="id" readonly
                                class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none hidden" />
                            <div class="w-full">
                                <label for="id_order_update">Id Order</label>
                                <input type="text" name="id_order" id="id_order_update" readonly
                                    class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none" />
                            </div>
                            <div class="w-full">
                                <label for="id_produk">Type Produk</label>
                                <input type="text" name="id_produk" id="id_produk_update"
                                    class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none" />
                            </div>
                            <div class="w-full flex flex-row space-x-4">
                                <div class="w-full">
                                    <label for="qty_update">Quantity</label>
                                    <input type="number" name="qty" id="qty_update"
                                        placeholder="Masukan jumlah produk"
                                        class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none" />
                                </div>
                                <div class="w-full">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" id="stock"
                                        class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none"
                                        readonly />
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="deadline_update">Deadline</label>
                                <input type="date" name="deadline" id="deadline_update"
                                    placeholder="Search Produk"
                                    class="p-2 rounded-md border border-gray-300 w-full sm:w-100 focus:outline-none" />
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="mt-3 ml-3 inline-flex w-full justify-center rounded-md bg-gray-800 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-900 sm:mt-0 sm:w-auto">Update
                                Order</button>
                            <button type="button" id="closeBtn"
                                class="mt-3 mx-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const toggleSidebar = () => {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const button = document.getElementById('button_nav');
            const tooltip = document.getElementById('tooltip');
            const menuText = document.querySelectorAll('.menu-text');
            const tooltips = document.querySelectorAll('.tooltip');

            if (sidebar.classList.contains('w-48')) {
                // Switch sidebar Kecil
                sidebar.classList.remove('w-48');
                sidebar.classList.add('w-16');
                content.classList.remove('ml-48');
                content.classList.add('ml-16');
                button.classList.remove('justify-end');
                button.classList.add('justify-center');
                menuText.forEach((text) => (text.style.display = 'none'));
            } else {
                // Switch Sidebar Besar
                sidebar.classList.remove('w-16');
                sidebar.classList.add('w-48');
                content.classList.remove('ml-16');
                content.classList.add('ml-48');
                button.classList.remove('justify-center');
                button.classList.add('justify-end');
                menuText.forEach((text) => (text.style.display = 'inline'));
            }
        };
    </script>
    <script>
        const calendarElement = document.getElementById('calendar');
        const currentMonthElement = document.getElementById('currentMonth');
        let currentView = 'month';
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth();

        const fetchOrders = async () => {
            try {
                const response = await fetch('/api/orders');
                return response.json();
            } catch (error) {
                console.error('Failed to fetch orders:', error);
                return [];
            }
        };

        const renderCalendar = async (view, year, month, day) => {
            const daysInWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const orders = await fetchOrders();
            const ordersMap = {};
            orders.forEach(order => {
                ordersMap[order.date] = order.count;
            });

            const today = new Date();
            const currentDateStr = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

            currentMonthElement.innerText = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

            if (view === 'day') {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const orderCount = ordersMap[dateStr] || 0;
                const isToday = dateStr === currentDateStr;
                calendarElement.innerHTML = `
                    <div class="text-white text-center">
                        <h2 class="text-2xl">${dateStr}</h2>
                        <div class="mt-4 p-4 rounded-lg ${isToday ? 'bg-white text-gray-800 font-bold' : 'bg-gray-500 text-white'}">
                            ${orderCount} Orders
                        </div>
                    </div>
                `;
            } else if (view === 'week' || view === 'month') {
                const date = new Date(year, month, 1);
                const firstDayIndex = date.getDay();
                const lastDay = new Date(year, month + 1, 0).getDate();
                const weekStart = view === 'week' ? today.getDate() - today.getDay() : 1;
                const weekEnd = view === 'week' ? weekStart + 6 : lastDay;

                calendarElement.innerHTML = `
                    <div class="grid grid-cols-7 gap-2 text-center font-medium text-white">
                        ${daysInWeek.map(day => `<div>${day}</div>`).join('')}
                    </div>
                    <div class="grid grid-cols-7 gap-2 mt-2">
                        ${Array(firstDayIndex).fill('<div></div>').join('')}
                        ${Array.from({ length: weekEnd - weekStart + 1 }, (_, i) => {
                            const dateNum = weekStart + i;
                            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(dateNum).padStart(2, '0')}`;
                            const orderCount = ordersMap[dateStr] || 0;
                            const isToday = dateStr === currentDateStr;
                            return `
                                <div class="p-2 rounded-lg ${isToday ? 'bg-white text-gray-800 font-bold' : orderCount ? 'bg-green-500 text-white font-bold' : 'text-white hover:bg-white hover:text-gray-800 transition-all duration-300'}">
                                    ${dateNum}
                                    ${orderCount ? `<span class="block text-sm mt-1">${orderCount} orders</span>` : ''}
                                </div>
                            `;
                        }).join('')}
                    </div>
                `;
            }
        };

        const changeCalendarView = (view) => {
            currentView = view;
            renderCalendar(view, currentYear, currentMonth, new Date().getDate());
        };

        const changeMonth = (direction) => {
            currentMonth += direction;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear -= 1;
            } else if (currentMonth > 11) {
                currentMonth = 0;
                currentYear += 1;
            }
            renderCalendar(currentView, currentYear, currentMonth, new Date().getDate());
        };

        renderCalendar(currentView, currentYear, currentMonth, new Date().getDate());
    </script>
    <script>
        // Event delegation untuk menangani klik pada tombol orderButton
        document.getElementById('ordersTable').addEventListener('click', function(event) {
            console.log('Clicked:', event.target);
            const button = event.target.closest('.orderButton');
            if (button) {
                console.log('Order button clicked');
                document.getElementById('orderModal').classList.remove('hidden');
            }
        });

        document.getElementById('ordersContainer').addEventListener('click', function(event) {
            // Ketika memilih produk, ambil stok produk dan tampilkan di modal
            if (event.target.classList.contains('updateButton')) {
                const Id = event.target.getAttribute('data-id');
                const orderId = event.target.getAttribute('data-id-order');
                const productId = event.target.getAttribute('data-produk');
                const qty = event.target.getAttribute('data-qty');
                const deadline = event.target.getAttribute('data-time');
                const formattedDeadline = new Date(deadline).toISOString().split('T')[0];
                document.getElementById('id').value = Id;
                document.getElementById('id_order_update').value = orderId;
                document.getElementById('id_produk_update').value = productId;
                document.getElementById('qty_update').value = qty;
                document.getElementById('deadline_update').value = formattedDeadline;
                document.getElementById('updateModal').classList.remove('hidden');
                console.log("Product ID:", productId);
                // Lakukan request untuk mengambil stok produk berdasarkan id
                fetch(`/get-stock/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Jika berhasil, tampilkan stok di input field
                        if (data.stock !== undefined) {
                            document.getElementById('stock').value = data.stock;
                        } else {
                            console.error("Stok tidak ditemukan");
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching stock data:', error);
                    });
            }
        });
        // Event listener untuk tombol cancel
        document.getElementById('cancelBtn').addEventListener('click', function() {
            document.getElementById('orderModal').classList.add('hidden');
        });
        document.getElementById('closeBtn').addEventListener('click', function() {
            document.getElementById('updateModal').classList.add('hidden');
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const orderContainer = document.getElementById("orderContainer");
            const addOrderBtn = document.getElementById("addOrderBtn");

            // Event listener untuk menambah order input
            addOrderBtn.addEventListener("click", function() {
                fetch('/produk')
                    .then(response => response.json())
                    .then(produkData => {
                        const orderGroup = document.createElement("div");
                        orderGroup.classList.add("order-input-group", "mt-4");

                        // Create select options dynamically using produkData
                        let optionsHTML = '<option value="">Pilih Produk</option>';
                        produkData.forEach(produk => {
                            optionsHTML +=
                                `<option value="${produk.id}">${produk.nama}</option>`;
                        });
                        orderGroup.innerHTML = `
                        <div class="order-input-group space-y-3">
                            <div class="w-full">
                                <label for="id_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <select name="id_produk[]" id="id_produk" class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    ${optionsHTML}
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="qty" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" name="qty[]" id="qty" placeholder="Masukan jumlah produk"
                                class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500" />
                            </div>
                            <div class="w-full">
                                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                                <input type="date" name="deadline[]" id="deadline"
                                    class="p-2 rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-gray-500" />
                            </div>
                            <button type="button" class="remove-order-btn mt-2 text-red-500 text-sm">Remove</button>
                        </div>`;
                        orderContainer.appendChild(orderGroup);
                        // Tambahkan event listener untuk tombol remove
                        const removeBtn = orderGroup.querySelector(".remove-order-btn");
                        removeBtn.addEventListener("click", function() {
                            orderContainer.removeChild(orderGroup);
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching produk:", error);
                    });
            });
        });
    </script>
    <script>
        // Fungsi untuk memuat data produk
        let allProduk = []; // Variabel untuk menyimpan semua produk

        function fetchProduk() {
            console.log('Fetching produk...');
            $.ajax({
                url: '/produk/fetch', // Endpoint untuk mengambil data
                method: 'GET',
                success: function(data) {
                    console.log('Data fetched successfully:', data); // Log data yang diterima
                    if (Array.isArray(data)) {
                        allProduk = data; // Simpan semua produk
                        updateProdukUI(allProduk); // Tampilkan semua produk
                    } else {
                        console.error('Unexpected data format:', data);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching produk:', xhr.status, xhr.responseText);
                }
            });
        }

        // Fungsi untuk memperbarui UI produk
        function updateProdukUI(produkList) {
            const container = document.getElementById('produk-container');
            if (!container) {
                console.error('Element with id "produk-container" not found.');
                return;
            }

            // Kosongkan kontainer sebelum menambahkan elemen baru
            container.innerHTML = '';

            // Tambahkan produk yang sesuai
            produkList.forEach(produk => {
                const produkHTML = `
                <div class="w-full max-w-md rounded-md overflow-hidden shadow-lg mx-auto" data-id="${produk.id}">
                    <img class="w-full max-h-64" src="https://dummyimage.com/400x400" alt="Image">
                    <div class="deskripsi flex flex-row">
                        <div class="flex-[1] flex flex-col px-4 py-4">
                            <h2 class="font-bold text-xl mb-2">${produk.nama}</h2>
                            <p class="text-gray-700 text-base">${produk.jenis}</p>
                            <p class="text-gray-700 text-base">${produk.ukuran}</p>
                        </div>
                        <div class="flex flex-[1] flex-col space-y-3 bg-gray-800 justify-center items-center py-4">
                            <h1 class="text-3xl font-extrabold text-white sm:text-lg md:text-xl lg:text-2xl">Orderan</h1>
                            <p class="text-3xl font-extrabold rounded-xl text-gray-800 bg-white px-5 py-5 text-center sm:text-xl md:text-2xl lg:text-3xl">${produk.orders_count || 0}</p>
                        </div>
                    </div>
                </div>`;
                container.insertAdjacentHTML('beforeend', produkHTML);
            });
        }

        // Fungsi untuk memfilter produk berdasarkan input pencarian
        function filterProduk(keyword) {
            const filteredProduk = allProduk.filter(produk =>
                produk.nama.toLowerCase().includes(keyword.toLowerCase())
            );
            updateProdukUI(filteredProduk);
        }

        // Tambahkan event listener ke input pencarian
        document.getElementById('search_produk').addEventListener('input', function() {
            const keyword = this.value;
            filterProduk(keyword); // Filter produk setiap kali pengguna mengetik
        });

        // Panggil fetchProduk pertama kali
        fetchProduk();

        // Set interval untuk polling data secara otomatis setiap 5 detik
        setInterval(fetchProduk, 5000);
    </script>
    <script>
        function fetchPage(page, type) {
            $.ajax({
                url: '{{ route('produk.index') }}',
                method: 'GET',
                data: {
                    page: type === 'done' ? null : page, // Page untuk ongoing
                    page_done: type === 'done' ? page : null // Page untuk done
                },
                success: function(response) {
                    if (type === 'done') {
                        // Update tabel untuk pesanan yang sudah selesai
                        $('#orders_done tbody').html(response.html);
                        // Update pagination untuk pesanan yang sudah selesai
                        $('#pagination_done').html(response.pagination);
                    } else {
                        // Update tabel untuk pesanan yang sedang berjalan
                        $('#orders tbody').html(response.html);
                        // Update pagination untuk pesanan yang sedang berjalan
                        $('#pagination_ongoing').html(response.pagination);
                    }
                }
            });
        }
    </script>
    <script>
        // Function to fade out messages after 3 seconds
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.style.transition = "opacity 0.5s ease-out";
                successMessage.style.opacity = 0;
                setTimeout(() => successMessage.remove(), 500); // Remove after fade-out
            }

            if (errorMessage) {
                errorMessage.style.transition = "opacity 0.5s ease-out";
                errorMessage.style.opacity = 0;
                setTimeout(() => errorMessage.remove(), 500); // Remove after fade-out
            }
        }, 3000); // 3 seconds
    </script>
    <script>
        // Fungsi untuk menghitung waktu tersisa
        function calculateTimeLeft(deadline) {
            const now = new Date();
            const deadlineDate = new Date(deadline);
            const timeDiff = deadlineDate - now;

            if (timeDiff <= 0) {
                return {
                    text: "Expired",
                    bgColor: "bg-red-500"
                }; // Waktu habis
            }

            // Menghitung bulan, hari, dan jam
            const months = Math.floor(timeDiff / (1000 * 60 * 60 * 24 * 30)); // Menghitung bulan
            const days = Math.floor((timeDiff % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24)); // Menghitung hari
            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); // Menghitung jam

            // Menentukan warna background berdasarkan sisa waktu
            let bgColor = "bg-green-500"; // Default hijau
            if (hours < 5 && days == 0 && months == 0) {
                bgColor = "bg-red-500"; // Jika sisa waktu < 5 jam, merah
            } else if (hours >= 5 && hours < 10 && days == 0 && months == 0) {
                bgColor = "bg-orange-500"; // Jika sisa waktu antara 5 hingga 10 jam, oranye
            } else if (days > 1) {
                bgColor = "bg-green-500";
            }

            // Menentukan format output berdasarkan sisa waktu
            let text = "";
            if (months > 0) {
                text = `${months} M, ${days} D, ${hours} H`;
            } else if (days > 0) {
                text = `${days} D, ${hours} H`;
            } else if (hours > 0) {
                text = `${hours} H`;
            } else {
                text = "Expired";
            }

            return {
                text,
                bgColor
            };
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk memperbarui timer
            function updateTimers() {
                const timers = document.querySelectorAll('.timer');
                timers.forEach(function(timer) {
                    const deadline = timer.getAttribute('data-deadline');
                    const {
                        text,
                        bgColor
                    } = calculateTimeLeft(deadline);
                    timer.textContent = text; // Menampilkan sisa waktu
                    timer.className = 'timer'; // Reset kelas sebelumnya
                    timer.classList.add(bgColor); // Menambahkan kelas warna background
                    timer.classList.add('px-4');
                    timer.classList.add('py-2');
                    timer.classList.add('rounded-lg');
                    timer.classList.add('text-white');
                    timer.classList.add('flex');
                });
            }
            // Update timer saat halaman dimuat
            updateTimers();
            // Update timer setiap detik
            setInterval(updateTimers, 100);
        });
    </script>
</body>

</html>
