<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE beritas MODIFY status ENUM('draft', 'published', 'rejected') NOT NULL DEFAULT 'draft'");

        Schema::table('beritas', function (Blueprint $table) {
            $table->text('alasan_penolakan')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('alasan_penolakan');
        });

        DB::statement("ALTER TABLE beritas MODIFY status ENUM('draft', 'published') NOT NULL DEFAULT 'draft'");
    }
};
