<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('judul_laporan')->nullable()->default('TENAGA PENUNJANG KEGIATAN (TPK)'); // New field for custom title
            $table->string('jabatan_staf')->nullable(); // New
            $table->string('bidang')->nullable(); // New
            
            $table->string('instansi');
            $table->string('keperluan')->default('-'); // Kept
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            
            // Atasan details
            $table->string('nama_atasan')->nullable(); // New
            $table->string('nip_atasan')->nullable(); // New
            $table->string('jabatan_atasan')->nullable(); // New
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};