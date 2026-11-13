<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radar_events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->string('artis_grup');
            $table->string('jenis_event', 50);
            $table->date('tanggal_event');
            $table->string('lokasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radar_events');
    }
};
