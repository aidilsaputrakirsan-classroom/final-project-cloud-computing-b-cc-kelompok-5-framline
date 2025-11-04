<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('films', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('sinopsis');
        $table->year('tahun_rilis');
        $table->string('sutradara');
        $table->string('aktor');
        $table->string('durasi');
        $table->string('poster')->nullable(); // untuk upload foto poster
        $table->foreignId('genre_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
