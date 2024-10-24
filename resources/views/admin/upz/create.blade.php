@extends('admin.layout.app')
@section('title', 'Daftar UPZ')
@section('content')
<div class="flex flex-col md:flex-row">
    <div class="flex-1 p-6 bg-gray-100 mt-16 md:ml-64">

        <!-- Map Section -->
        
            <h2 class="text-2xl font-bold mb-4 text-center md:text-left">Lokasi Unit Pengumpul Zakat (UPZ)</h2>
            <div id="map" class="w-550 h-96 rounded-lg z-0"></div>
      

        <!-- Button Tambah UPZ & Search Input -->
        <div class="flex flex-col md:flex-row justify-between items-center mt-6">
            <button id="openModalButton" class="bg-green-600 text-white px-6 py-3 rounded-md font-bold hover:bg-green-700 transition duration-300 mb-4 md:mb-0">
                Tambah UPZ
            </button>

            <!-- Search Input -->
            <input type="text" id="searchInput" placeholder="Cari Nama UPZ..." 
                   class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
        </div>

        <!-- Tabel Daftar UPZ -->
        <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
            <h2 class="text-2xl font-bold mb-4 text-center md:text-left">Daftar UPZ</h2>

            <!-- Scrollable Table -->
            <div class="overflow-y-auto max-h-80"> <!-- Membatasi ketinggian tabel dan menambahkan scrolling -->
                <table id="upzTable" class="min-w-full bg-white border rounded-lg">
                    <thead class="bg-gray-200 sticky top-0"> <!-- Header tabel tetap terlihat saat scroll -->
                        <tr>
                            <th class="py-2 px-4 border">Nama UPZ</th>
                            <th class="py-2 px-4 border">Nama Ketua</th>
                            <th class="py-2 px-4 border">Alamat</th>
                            <th class="py-2 px-4 border">Nomor Telepon</th>
                            <th class="py-2 px-4 border">Tanggal Berlaku SK</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="upzTableBody">
                        @foreach ($upzList as $upz)
                            <tr>
                                <td class="py-2 px-4 border">{{ $upz->nama_upz }}</td>
                                <td class="py-2 px-4 border">{{ $upz->nama_ketua }}</td>
                                <td class="py-2 px-4 border">{{ $upz->alamat_upz }}</td>
                                <td class="py-2 px-4 border">{{ $upz->nomor_telepon }}</td>
                                <td class="py-2 px-4 border">{{ $upz->tanggal_berlaku }}</td>
                                <td class="py-2 px-4 border text-center">
                                    <!-- Grid untuk tampilan mobile -->
                                    <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                                        <!-- Tombol Edit untuk membuka modal -->
                                        <button 
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md font-bold hover:bg-blue-700 transition duration-300 w-full md:w-auto"
                                            onclick="openEditModal({{ json_encode($upz) }})"
                                        >
                                            Edit
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form 
                                            action="{{ route('admin.upz.destroy', $upz->id) }}" 
                                            method="POST" 
                                            class="inline-block w-full md:w-auto" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus UPZ ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="bg-red-500 text-white px-4 py-2 rounded-md font-bold hover:bg-red-700 transition duration-300 w-full md:w-auto"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

       <!-- Modal Form Tambah/Edit UPZ -->
<!-- Modal Form Tambah/Edit UPZ -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-2/3 max-h-screen p-6 relative max-h-96 md:max-h-screen"> <!-- Tambahkan ml-auto di sini -->

        <!-- Modal Title -->
        <h2 id="modalTitle" class="text-xl md:text-3xl font-bold mb-6 text-center md:text-left">Form Tambah UPZ</h2>

        <!-- Form -->
        <form id="upzForm" action="{{ route('admin.upz.store') }}" method="POST">
            @csrf

            <!-- Scrollable Input Fields -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 overflow-y-auto h-72"> <!-- Membatasi tinggi form dan memberikan overflow -->
                <!-- Nama UPZ -->
                <div>
                    <label for="nama_upz" class="block text-base font-medium text-gray-700">Nama UPZ</label>
                    <input type="text" id="nama_upz" name="nama_upz" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" 
                        placeholder="Masukkan Nama UPZ" required>
                </div>

                <!-- Nama Ketua UPZ -->
                <div>
                    <label for="nama_ketua" class="block text-base font-medium text-gray-700">Nama Ketua UPZ</label>
                    <input type="text" id="nama_ketua" name="nama_ketua" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" 
                        placeholder="Masukkan Nama Ketua UPZ" required>
                </div>

                <!-- Alamat UPZ -->
                <div>
                    <label for="alamat_upz" class="block text-base font-medium text-gray-700">Alamat UPZ</label>
                    <input type="text" id="alamat_upz" name="alamat_upz" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" 
                        placeholder="Masukkan Alamat UPZ" required>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="nomor_telepon" class="block text-base font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="nomor_telepon" name="nomor_telepon" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" 
                        placeholder="Masukkan Nomor Telepon" required>
                </div>

                <!-- Tanggal Berlaku SK -->
                <div>
                    <label for="tanggal_berlaku" class="block text-base font-medium text-gray-700">Tanggal Berlaku SK UPZ</label>
                    <input type="date" id="tanggal_berlaku" name="tanggal_berlaku" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" required>
                </div>

                <!-- Latitude -->
                <div>
                    <label for="latitude" class="block text-base font-medium text-gray-700">Latitude</label>
                    <input type="text" id="latitude" name="latitude" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" 
                        placeholder="Masukkan Latitude" required>
                </div>

                <!-- Longitude -->
                <div>
                    <label for="longitude" class="block text-base font-medium text-gray-700">Longitude</label>
                    <input type="text" id="longitude" name="longitude" 
                        class="mt-1 block w-full md:max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-900 placeholder-gray-400 text-base py-3 px-4" 
                        placeholder="Masukkan Longitude" required>
                </div>
            </div>

            <!-- Submit and Close Button on Mobile -->
            <div class="flex justify-between mt-6">
                <!-- Close Button for Mobile -->
                <button type="button" id="closeModalButtonMobile" class="bg-gray-500 text-white px-4 py-2 rounded-md font-bold hover:bg-gray-600 transition duration-300">
                    Close
                </button>

                <!-- Submit Button -->
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-md font-bold hover:bg-green-700 transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

    </div>
</div>

<!-- Script untuk mengatur modal dan pencarian -->
<script>
     document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('upzForm').reset(); // Reset form saat buka modal
        document.getElementById('modalTitle').innerText = 'Form Tambah UPZ'; // Ubah judul modal jadi "Tambah UPZ"
        document.getElementById('upzForm').action = "{{ route('admin.upz.store') }}"; // Ubah action form untuk penambahan
        let methodField = document.querySelector('input[name="_method"]');
        if (methodField) {
            methodField.remove();
        }
    });

 

    document.getElementById('closeModalButtonMobile').addEventListener('click', function() {
        document.getElementById('modal').classList.add('hidden');
    });

    // Pencarian Nama UPZ
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var rows = document.getElementById('upzTableBody').getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cell = rows[i].getElementsByTagName('td')[0]; // Nama UPZ ada di kolom pertama
            if (cell) {
                var txtValue = cell.textContent || cell.innerText;
                if (txtValue.toLowerCase().indexOf(searchValue) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });

    // Fungsi untuk membuka modal edit dan mengisi form dengan data UPZ yang dipilih
    function openEditModal(upz) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modalTitle').innerText = 'Edit UPZ'; // Ubah judul modal jadi "Edit UPZ"

        // Isi form dengan data UPZ
        document.getElementById('nama_upz').value = upz.nama_upz;
        document.getElementById('nama_ketua').value = upz.nama_ketua;
        document.getElementById('alamat_upz').value = upz.alamat_upz;
        document.getElementById('nomor_telepon').value = upz.nomor_telepon;
        document.getElementById('tanggal_berlaku').value = upz.tanggal_berlaku;
        document.getElementById('latitude').value = upz.latitude;
        document.getElementById('longitude').value = upz.longitude;

        // Ubah action form untuk melakukan update
        document.getElementById('upzForm').action = `/admin/upz/${upz.id}`;

        // Tambahkan method PUT secara dinamis
        let methodField = document.createElement('input');
        methodField.setAttribute('type', 'hidden');
        methodField.setAttribute('name', '_method');
        methodField.setAttribute('value', 'PUT');
        document.getElementById('upzForm').appendChild(methodField);
    }

    // Script untuk Leaflet Map
    var map = L.map('map').setView([0.1367565, 117.464279], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 12,
    }).addTo(map);

    // Buat array untuk menyimpan semua koordinat marker
    var markers = [];

    // Loop untuk menambahkan marker UPZ pada map
    @foreach($upzList as $upz)
        var marker = L.marker([{{ $upz->latitude }}, {{ $upz->longitude }}]).addTo(map)
            .bindPopup("<b>{{ $upz->nama_upz }}</b><br>{{ $upz->alamat_upz }}<br>{{ $upz->nama_ketua }}<br>{{ $upz->nomor_telepon }}");
        
        // Tambahkan koordinat ke dalam array markers
        markers.push([{{ $upz->latitude }}, {{ $upz->longitude }}]);
    @endforeach

    // Gunakan fitBounds untuk mengatur peta agar mencakup semua marker
    var bounds = L.latLngBounds(markers);
    map.fitBounds(bounds);
</script>

@endsection
