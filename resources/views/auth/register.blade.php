<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi User - BAZNAS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 relative">

    <!-- Background image with blur effect -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/baznaz.png') }}');"></div>

    <!-- Registration Form Box -->
    <div class="relative z-10 bg-white bg-opacity-80 rounded-2xl shadow-md p-8 w-full max-w-lg">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Nama Input -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
                <input type="text" name="name" id="name" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Alamat Input -->
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                <input type="text" name="address" id="address" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- No HP Input -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-semibold mb-2">No HP</label>
                <input type="text" name="phone" id="phone" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Konfirmasi Password Input -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Button Register in bottom-right corner -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-green-600 text-white font-bold py-3 px-6 rounded-full hover:bg-green-700 transition duration-300 ease-in-out">
                    Daftar User
                </button>
            </div>

        </form>
    </div>

</body>
</html>
