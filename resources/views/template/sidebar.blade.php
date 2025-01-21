<!-- Sidebar -->
<div id="sidebar"
    class="bg-gray-800 text-white w-48 fixed top-0 left-0 h-full flex flex-col items-center transition-all duration-300">
    <div id="button_nav" class="w-full flex justify-end p-4">
        <button onclick="toggleSidebar()"
            class="min-w-10 min-h-10 p-2 bg-gray-700 hover:bg-gray-600 focus:outline-none flex items-center justify-center rounded-lg">
            &#9776;
        </button>
    </div>
    <!-- Garis pemisah -->
    <hr class="w-full border-gray-600 my-4">
    <!-- Navigation List -->
    <ul class="mt-2 space-y-4 flex flex-col items-start w-full">
        <li class="group relative w-full">
            <a href="#product" class="flex items-center space-x-4 py-2 px-4 hover:bg-gray-700 rounded">
                <span class="material-icons text-2xl">inventory_2</span>
                <span class="menu-text">Product</span>
            </a>
        </li>
        <li class="group relative w-full">
            <a href="#calendars" class="flex items-center space-x-4 py-2 px-4 hover:bg-gray-700 rounded">
                <span class="material-icons text-2xl">calendar_month</span>
                <span class="menu-text">Calendar</span>
            </a>
        </li>
        <li class="group relative w-full">
            <a href="#orders" class="flex items-center space-x-4 py-2 px-4 hover:bg-gray-700 rounded">
                <span class="material-icons text-2xl">table_chart</span>
                <span class="menu-text">Orders</span>
            </a>
        </li>
    </ul>
    <!-- Garis pemisah -->
    <hr class="w-full border-gray-600 my-4">
    <!-- Akun Dropdown -->
    <div class="mt-auto w-full">
        <details class="group relative">
            <summary
                class="flex items-center space-x-4 py-2 px-4 cursor-pointer hover:bg-gray-700 rounded focus:outline-none">
                <span class="material-icons text-2xl">account_circle</span>
                @if (session('username'))
                    <span class="menu-text">{{ session('username') }}</span>
                @else
                    <span class="menu-text">Null</span>
                @endif
            </summary>
            <div class="absolute left-0 bottom-full mb-2 bg-gray-700 text-white rounded shadow-md">
                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 w-full text-left hover:bg-gray-600">
                        <span class="material-icons text-2xl mr-4">logout</span>
                        <span class="menu-text">Logout</span>
                    </button>
                </form>
            </div>
        </details>
    </div>
</div>
