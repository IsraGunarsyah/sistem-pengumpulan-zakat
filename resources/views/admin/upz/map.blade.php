@extends('admin.layout.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Peta UPZ</h1>
        <div id="map" class="w-full h-96 bg-gray-200">
            <!-- Placeholder untuk peta UPZ -->
            <!-- Anda bisa menambahkan peta dengan menggunakan leaflet.js atau Google Maps API -->
        </div>
    </div>

    <script>
        // Contoh menggunakan leaflet.js
        var map = L.map('map').setView([-6.1751, 106.8650], 13); // Sesuaikan lokasi dengan data UPZ

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Marker untuk UPZ - tambahkan marker sesuai dengan data UPZ
        L.marker([-6.1751, 106.8650]).addTo(map)
            .bindPopup('Lokasi UPZ.')
            .openPopup();
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection
