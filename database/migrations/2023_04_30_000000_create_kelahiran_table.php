<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->timestamps();
        });

        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->timestamps();
        });

        Schema::create('kelahiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained(
                table: 'periode',
                indexName: 'periode_id'
            );
            $table->foreignId('desa_id')->constrained(
                table: 'desa',
                indexName: 'desa_id'
            );
            $table->string('nama_anak');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->string('alamat');
            $table->integer('umur_ibu');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->integer('jumlah_anak_hidup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelahiran');
        Schema::dropIfExists('periode');
        Schema::dropIfExists('desa');
    }
};
