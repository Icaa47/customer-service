<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("closings", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->constrained("users")
                ->onDelete("cascade");
            $table->string("klien");
            $table->string("bisnis");
            $table->string("produk");
            $table->decimal("jumlah", 15, 2);
            $table->decimal("poin", 8, 2)->default(0);
            $table
                ->enum("status", ["Selesai", "Pending", "Gagal"])
                ->default("Pending");
            $table->timestamps(); // Ini akan otomatis membuat 'waktu' (created_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("closings");
    }
};
