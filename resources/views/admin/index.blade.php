@extends('admin.layout.app')

@section('content')
<div class="flex flex-col md:flex-row">
    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-100 mt-16 md:ml-64">
    
        <!-- Dashboard Content -->
        <div class="mt-4">
            <h1 class="text-3xl font-bold text-green-600 mb-6 text-center md:text-left">Dashboard</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Card 1: Total Users -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center flex flex-col items-center justify-center transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="text-green-500 text-6xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="block text-4xl font-semibold mt-2 text-gray-800">{{ $totalUsers }}</span>
                    <span class="block text-gray-500 text-lg">Total Users</span>
                </div>
            
                <!-- Card 2: Total UPZ -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center flex flex-col items-center justify-center transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="text-blue-500 text-6xl">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="block text-4xl font-semibold mt-2 text-gray-800">{{ $totalUPZ }}</span>
                    <span class="block text-gray-500 text-lg">Total UPZ</span>
                </div>
            </div>
            
            <!-- Leaflet Map Section -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4 text-center md:text-left">Map UPZ</h2>
                <div id="map" class="rounded-lg overflow-hidden shadow-lg" style="height: 450px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet JS -->
<script>
    var map = L.map('map').setView([0.1367565, 117.464279], 13); // Set default center and zoom
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Buat array untuk menyimpan semua koordinat marker
    var markers = [];

    // Loop untuk menambahkan marker UPZ pada map dari data yang diambil dari database
    @foreach($upzList as $upz)
        var marker = L.marker([{{ $upz->latitude }}, {{ $upz->longitude }}]).addTo(map)
            .bindPopup("<b>{{ $upz->nama_upz }}</b><br>{{ $upz->alamat_upz }}<br>{{ $upz->nama_ketua }}<br>{{ $upz->nomor_telepon }}");

        // Tambahkan koordinat ke dalam array markers
        markers.push([{{ $upz->latitude }}, {{ $upz->longitude }}]);
    @endforeach

    // Gunakan fitBounds untuk menyesuaikan peta agar mencakup semua marker
    if (markers.length > 0) {
        var bounds = L.latLngBounds(markers);
        map.fitBounds(bounds);
    }
</script>
@endsection
