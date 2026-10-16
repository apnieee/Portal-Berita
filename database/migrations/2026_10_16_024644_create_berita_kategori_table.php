<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_kategori', function (Blueprint $table) {
            $table->integer('id_berita');
            $table->integer('id_kategori');

            $table->primary(['id_berita', 'id_kategori']);

            $table->foreign('id_berita')
                ->references('id_berita')
                ->on('berita')
                ->onDelete('cascade');

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->onDelete('cascade');
        });

        // Salin hubungan kategori lama tanpa menghapus data aslinya.
        DB::table('berita')->select('id_berita', 'id_kategori')
            ->orderBy('id_berita')
            ->chunk(500, function ($beritas) {
                DB::table('berita_kategori')->insert(
                    $beritas->map(fn ($berita) => [
                        'id_berita' => $berita->id_berita,
                        'id_kategori' => $berita->id_kategori,
                    ])->all()
                );
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_kategori');
    }
};