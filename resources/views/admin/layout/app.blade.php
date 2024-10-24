

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</head>
<body class="min-h-screen bg-gray-100">

 
 <!-- Sidebar -->
<div id="sidebar" class="w-64 bg-green-600 h-screen fixed top-0 left-0 text-slate-700 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-50 shadow-lg">
    <!-- Head Sidebar dengan background putih -->
    <div class="relative bg-white p-6 flex justify-center items-center">
        <!-- Flex untuk logo di tengah -->
        <img src="{{ asset('images/logobaznas.png') }}" alt="BAZNAS Logo" class="h-16">
        <!-- Tombol Close (hanya muncul di layar mobile) -->
        <button onclick="toggleSidebar()" class="absolute top-2 right-2 md:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Profil User -->
    <div class="p-4 bg-green-600 mt-4 rounded-lg shadow-md flex items-center space-x-4">
        <i class="text-white fa-solid fa-user"></i>
        <div class="text-white">
            <h4 class="text-sm text-white font-semibold">{{ Auth::user()->name }}</h4> 
            <p class="text-xs text-gray-200">Admin</p>
        </div>
    </div>

    <!-- Pembatas (divider) -->
    <hr class="border-t-2 border-white mt-4 mb-4">

    <!-- Navigasi -->
    <div class="items-center block w-auto max-h-screen overflow-auto grow">
        <ul class="flex flex-col pl-4 mb-0 space-y-4">
            <!-- Dashboard -->
            <li class="mt-1 w-full">
                <a href="{{ route('admin.index') }}"
                   class="flex items-center text-base font-semibold p-2 rounded-md {{ request()->is('admin/dashboard') ? 'bg-green-800 text-white' : 'hover:bg-green-400 hover:text-white ' }} transition-all">
                   <i class="text-white fas fa-tachometer-alt h-5 w-5"></i>
                   <span class="text-white ml-2">Dashboard</span>
                </a>
            </li>
            <!-- Map UPZ -->
            <li class="mt-0.5 w-full">
                <a href="{{ route('admin.upz.create') }}"
                   class="flex items-center text-base font-semibold p-2 rounded-md {{ request()->is('admin/upz/create') ? 'bg-green-800 text-white' : 'hover:bg-green-400 hover:text-white ' }} transition-all">
                   <i class="text-white fas fa-map-marker-alt h-5 w-5"></i>
                   <span class="ml-2 text-white">Map UPZ</span>
                </a>
            </li>
            <!-- Logout -->
            <li class="mt-0.5 w-full">
                <!-- Logout form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="flex items-center text-base font-semibold p-2 rounded-md hover:bg-red-500 transition-all">
                   <i class="text-white fas fa-sign-out-alt h-5 w-5"></i>
                   <span class="text-white ml-2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>




    <!-- Navbar -->
    <div class="bg-white py-6 px-6 flex justify-between items-center fixed top-0 left-0 md:left-64 right-0 z-10 w-full">
        <!-- Tombol toggle untuk layar kecil -->
        <button onclick="toggleSidebar()" class="md:hidden focus:outline-none">
            <i class="fas fa-bars h-6 w-6 text-green-600"></i>
        </button>
        <!-- Logo dan teks di layar besar, disembunyikan di layar kecil -->
        <div class="hidden md:flex items-center text-green-600 font-bold">
            <span class="ml-2 text-2xl">Di Sistem Informasi Geografis Unit Pengumpul Zakat <br> BAZNAS Kota Bontang</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="md:ml-6 mt-1 p-6 relative z-0">
        @yield('content')
    </div>

    <script>
        // Apply a higher z-index to the map for responsiveness
        var mapDiv = document.getElementById('map');
        if (window.innerWidth <= 768) {
            mapDiv.classList.add('relative', 'z-0'); // Lower z-index on mobile screens
        }


         // Timer untuk memperingatkan pengguna beberapa menit sebelum sesi habis (misalnya 18 menit dari 20 menit timeout)
    var warningTime = 18 * 60 * 1000; // 18 menit dalam milidetik

    setTimeout(function() {
    alert('Sesi Anda akan segera berakhir. Silakan simpan pekerjaan Anda atau lakukan sesuatu untuk tetap login.');
        }, warningTime);
    </script>
</body>
</html>
