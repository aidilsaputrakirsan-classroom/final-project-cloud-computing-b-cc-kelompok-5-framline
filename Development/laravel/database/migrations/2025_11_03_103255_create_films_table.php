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
        if (!Schema::hasTable('films')) {
            Schema::create('films', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->text('sinopsis');
                $table->integer('tahun_rilis');
                $table->string('sutradara');
                $table->string('aktor')->nullable();
                $table->string('durasi')->nullable();
                $table->string('poster')->nullable();
                $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
