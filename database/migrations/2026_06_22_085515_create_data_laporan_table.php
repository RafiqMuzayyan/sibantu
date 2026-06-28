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
        Schema::create('data_laporan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('judul');

            $table->text('deskripsi')
                ->nullable();

            $table->string('file');

            $table->date('tanggal_mulai')
                ->nullable();

            $table->date('tanggal_selesai')
                ->nullable();

            $table->string('kategori')
                ->default('semua');

            $table->string('status')
                ->default('semua');

            $table->integer('total_aduan')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_laporan');
    }
};
