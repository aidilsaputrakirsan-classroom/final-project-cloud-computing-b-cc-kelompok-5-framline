<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique()->nullable(); // optional username
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // 👇 tambahan kolom profil
            $table->string('photo')->nullable(); // foto profil
            $table->string('phone')->nullable(); // nomor telepon
            $table->string('address')->nullable(); // alamat pengguna
            $table->json('notification_preferences')->nullable(); // notifikasi (email/push/SMS)

            // 👇 flag admin
            $table->boolean('is_admin')->default(false); // default bukan admin

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
