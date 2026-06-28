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
        Schema::create('data_bukti_aduan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aduan_id')
                ->constrained('data_aduan')
                ->onDelete('cascade');

            $table->string('file');
            $table->string('nama_asli');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bukti_aduan');
    }
};
