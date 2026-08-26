<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['panduan', 'pencegahan']);
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('deskripsi', 500);
            $table->longText('konten');
            $table->string('icon')->default('bi-file-earmark-text');
            $table->string('waktu_baca')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
