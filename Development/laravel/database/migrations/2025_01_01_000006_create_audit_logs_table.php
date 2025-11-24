<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id(); // log_id
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('film_id')->nullable()->constrained('films')->onDelete('set null');
            $table->string('action'); // tambah, edit, hapus
            $table->timestamp('performed_at')->useCurrent();
            $table->text('meta')->nullable(); // optional JSON details
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
