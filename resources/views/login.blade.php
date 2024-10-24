<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - BAZNAS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 relative">

    <!-- Background image with blur effect -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/baznaz.png') }}');"></div>

    <!-- Login Form Box -->
    <div class="relative z-10 bg-white bg-opacity-80 rounded-2xl shadow-md p-8 w-full max-w-lg">

        @if (session('warning'))
    <div class="bg-yellow-500 text-white p-4 rounded-md">
        {{ session('warning') }}
    </div>
@endif

        <!-- Flash Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="text" name="email" id="email" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Buttons for Login and Registration -->
            <div class="flex justify-between mt-4">
                <!-- Button for Registration -->
                <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:text-green-700 transition duration-300 ease-in-out">
                    Registrasi
                </a>
                <!-- Button Login -->
                <button type="submit" class="bg-green-600 text-white font-bold py-3 px-6 rounded-full hover:bg-green-700 transition duration-300 ease-in-out">
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>
