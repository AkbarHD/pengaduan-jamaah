<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('konten');
            $table->dropColumn('icon');
        });
    }

    public function down(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->string('icon')->default('bi-file-earmark-text')->after('konten');
            $table->dropColumn('thumbnail');
        });
    }
};
