<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('upzs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_upz');
        $table->string('nama_ketua');
        $table->string('alamat_upz');
        $table->string('nomor_telepon');
        $table->date('tanggal_berlaku');
        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upzs');
    }
};
