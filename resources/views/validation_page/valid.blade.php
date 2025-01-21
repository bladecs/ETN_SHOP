<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom right, #00c6ff, #0072ff);
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-700" id="form-title">Login</h1>
            <p class="text-sm text-gray-500" id="form-subtitle">Masukkan akun Anda untuk melanjutkan</p>
        </div>
        @if ($errors->any())
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mt-6">
            <!-- Login Form -->
            <form id="login-form" class="space-y-4" action="{{ route('validation') }}" method="POST">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="username" id="login-username" name="username"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan username Anda">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="login-password" name="password"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan password Anda">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                    Login
                </button>
            </form>

            <!-- Register Form -->
            <form id="register-form" class="space-y-4 hidden" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" id="register-email" name="email"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan email">
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="username" id="register-username" name="username"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan username Anda">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="register-password" name="password"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Buat password">
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">
                    Daftar
                </button>
            </form>
        </div>
        <div class="mt-4 text-center">
            <p id="toggle-text" class="text-sm text-gray-500">
                Belum punya akun?
                <button id="toggle-button" class="text-blue-500 hover:underline">Daftar</button>
            </p>
        </div>
    </div>

    <script>
        // JavaScript untuk switching form
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const toggleButton = document.getElementById('toggle-button');
        const formTitle = document.getElementById('form-title');
        const formSubtitle = document.getElementById('form-subtitle');
        const toggleText = document.getElementById('toggle-text');

        document.getElementById('toggle-text').addEventListener('click', (event) => {
            if (event.target.id === 'toggle-button') {
                const isLoginVisible = !loginForm.classList.contains('hidden');

                if (isLoginVisible) {
                    // Tampilkan Register
                    loginForm.classList.add('hidden');
                    registerForm.classList.remove('hidden');
                    formTitle.textContent = 'Register';
                    formSubtitle.textContent = 'Buat akun baru Anda';
                    toggleText.innerHTML =
                        'Sudah punya akun? <button id="toggle-button" class="text-blue-500 hover:underline">Login</button>';
                } else {
                    // Tampilkan Login
                    registerForm.classList.add('hidden');
                    loginForm.classList.remove('hidden');
                    formTitle.textContent = 'Login';
                    formSubtitle.textContent = 'Masukkan akun Anda untuk melanjutkan';
                    toggleText.innerHTML =
                        'Belum punya akun? <button id="toggle-button" class="text-blue-500 hover:underline">Daftar</button>';
                }
            }
        });
    </script>
</body>

</html>
