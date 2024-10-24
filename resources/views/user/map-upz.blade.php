@extends('user.layout.app')

@section('title', 'Map UPZ')

@section('content')

<div class="flex flex-col md:flex-row">
    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-100 mt-16 md:ml-64">
    
        <!-- Dashboard Content -->
        <div class="mt-4">
            <h1 class="text-3xl font-bold text-green-600 mb-6 text-center md:text-left">Map UPZ</h1>

            <!-- Search Input -->
            <div class="w-full md:w-1/3 mx-auto mb-6">
                <input id="searchInput" type="text" placeholder="Cari UPZ..." 
                       class="w-full p-4 text-lg rounded-lg shadow-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            
            <!-- Leaflet Map Section -->
            <div class="mt-8 relative">
                <div id="map" class="rounded-lg overflow-hidden shadow-lg" style="height: 450px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet Map Script -->
<script>
    var map = L.map('map').setView([0.1367565, 117.464279], 13); // Set default center and zoom
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    var markers = [];
    var markerData = [];

    // Loop through the UPZ data and place markers on the map
    @foreach($upzMap as $upz)
        var marker = L.marker([{{ $upz->latitude }}, {{ $upz->longitude }}]).addTo(map);
        
        // Bind popup to marker
        marker.bindPopup(
            `<b>Nama UPZ: </b>{{ $upz->nama_upz }}<br>
             <b>Alamat: </b>{{ $upz->alamat_upz }}<br>
             <b>Ketua: </b>{{ $upz->nama_ketua }}<br>
             <b>No. Telepon: </b>{{ $upz->nomor_telepon }}<br>
             <b>SK UPZ: </b>{{ $upz->tanggal_berlaku }}`
        );

        markers.push(marker);
        markerData.push({
            nama: "{{ $upz->nama_upz }}",
            alamat: "{{ $upz->alamat_upz }}",
            ketua: "{{ $upz->nama_ketua }}",
            latitude: {{ $upz->latitude }},
            longitude: {{ $upz->longitude }},
            marker: marker
        });
    @endforeach

    // Adjust the map view to include all markers
    if (markers.length > 0) {
        var bounds = L.latLngBounds(markers.map(marker => marker.getLatLng()));
        map.fitBounds(bounds);
    }

    // Function to filter markers based on search input
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var found = false;

        markers.forEach(function(marker, index) {
            var upz = markerData[index];
            if (upz.nama.toLowerCase().includes(searchValue) || upz.ketua.toLowerCase().includes(searchValue)) {
                marker.addTo(map); // Show marker if it matches
                if (!found) {
                    // Move map view to the matching marker
                    map.setView([upz.latitude, upz.longitude], 16); // Focus the map on the matching UPZ
                    upz.marker.openPopup(); // Open the popup for the matching marker
                    found = true;
                }
            } else {
                map.removeLayer(marker); // Hide marker if it doesn't match
            }
        });

        // If no UPZ matches, reset the map view
        if (!found && searchValue === '') {
            map.fitBounds(L.latLngBounds(markers.map(marker => marker.getLatLng())));
        }
    });
</script>
@endsection
