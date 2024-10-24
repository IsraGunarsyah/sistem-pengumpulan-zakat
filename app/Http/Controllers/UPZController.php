<?php

namespace App\Http\Controllers;

use App\Models\upzs;
use App\Models\User;
use Illuminate\Http\Request;

class UPZController extends Controller
{
    public function create()
    {
        // Hitung total pengguna dengan role 'user' (tanpa admin)
        $totalUsers = User::where('role', 'user')->count();

        // Hitung total UPZ
        $totalUPZ = upzs::count();

        // Ambil semua UPZ
        $upzList = upzs::all();

        return view('admin.upz.create', compact('totalUsers', 'totalUPZ', 'upzList'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_upz' => 'required|string|max:255',
        'nama_ketua' => 'required|string|max:255',
        'alamat_upz' => 'required|string|max:255',
        'nomor_telepon' => 'required|string|max:15',
        'tanggal_berlaku' => 'required|date',
        'latitude' => 'required|numeric|between:-90,90', // Latitude harus di antara -90 sampai 90
        'longitude' => 'required|numeric|between:-180,180', // Longitude harus di antara -180 sampai 180
    ]);

    // Simpan data ke tabel upzs
    upzs::create([
        'nama_upz' => $request->nama_upz,
        'nama_ketua' => $request->nama_ketua,
        'alamat_upz' => $request->alamat_upz,
        'nomor_telepon' => $request->nomor_telepon,
        'tanggal_berlaku' => $request->tanggal_berlaku,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
    ]);

    // Redirect setelah berhasil menyimpan data
    return redirect()->route('admin.upz.create')->with('success', 'Data UPZ berhasil ditambahkan!');
}


public function edit($id)
{
    // Mengambil data UPZ berdasarkan ID
    $upz = upzs::findOrFail($id);

    // Mengarahkan ke halaman edit dengan data UPZ yang dipilih
    return view('admin.upz.edit', compact('upz'));
}


public function update(Request $request, $id)
{
    // Validasi data yang diinput
    $request->validate([
        'nama_upz' => 'required|string|max:255',
        'nama_ketua' => 'required|string|max:255',
        'alamat_upz' => 'required|string',
        'nomor_telepon' => 'required|string|max:15',
        'tanggal_berlaku' => 'required|date',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // Cari UPZ berdasarkan ID dan update datanya
    $upz = upzs::findOrFail($id);
    $upz->update([
        'nama_upz' => $request->nama_upz,
        'nama_ketua' => $request->nama_ketua,
        'alamat_upz' => $request->alamat_upz,
        'nomor_telepon' => $request->nomor_telepon,
        'tanggal_berlaku' => $request->tanggal_berlaku,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
    ]);

    // Redirect kembali ke halaman daftar UPZ dengan pesan sukses
    return redirect()->route('admin.upz.create')->with('success', 'Data UPZ berhasil diperbarui!');
}


public function destroy($id)
{
    // Menghapus data UPZ berdasarkan ID
    $upz = upzs::findOrFail($id);
    $upz->delete();

    // Redirect kembali ke halaman daftar UPZ dengan pesan sukses
    return redirect()->route('admin.upz.create')->with('success', 'Data UPZ berhasil dihapus!');
}


    

}
