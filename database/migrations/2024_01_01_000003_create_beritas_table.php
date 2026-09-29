<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->integer('id_berita')->autoIncrement();
            $table->integer('id_kategori');
            $table->integer('id_user');
            $table->string('judul', 255);
            $table->text('isi');
            $table->string('gambar', 255)->nullable();
            $table->string('status', 20);
            $table->integer('views')->default(0);
            $table->integer('featured')->default(0);
            $table->dateTime('tanggal');

            $table->primary('id_berita');

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};