<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poin_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users'); // Super Admin yg request
            $table->foreignId('user_id')->constrained('users');      // User yg poinnya salah
            $table->text('notes')->nullable();                      // Catatan dari Super Admin
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('read_at')->nullable(); // Untuk notifikasi Super Admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poin_requests');
    }
};
