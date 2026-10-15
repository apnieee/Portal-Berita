<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->boolean('tampil_di_beranda')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
             $table->dropColumn('tampil_di_beranda');
        });
    }
};
