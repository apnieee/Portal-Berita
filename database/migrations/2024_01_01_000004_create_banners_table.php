<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->integer('id_banner')->autoIncrement();
            $table->integer('id_berita');
            $table->string('gambar', 255)->nullable();
            $table->integer('status')->default(1);

            $table->primary('id_banner');

            $table->foreign('id_berita')
                ->references('id_berita')
                ->on('berita');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner');
    }
};