<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            // ✅ tambahkan kolom poster jika belum ada
            if (!Schema::hasColumn('films', 'poster')) {
                $table->string('poster')->nullable()->after('id');
            }

            // ✅ tambahkan relasi ke user (opsional)
            if (!Schema::hasColumn('films', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn(['poster', 'user_id']);
        });
    }
};
