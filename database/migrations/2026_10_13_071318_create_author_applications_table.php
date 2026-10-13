<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('author_applications', function (Blueprint $table) {
            $table->id();

            $table->integer('id_user');
            $table->text('alasan');

            $table->string('status')->default('pending');
            $table->text('catatan_admin')->nullable();

            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('user')
                ->cascadeOnDelete();

            $table->unique('id_user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('author_applications');
    }
};
