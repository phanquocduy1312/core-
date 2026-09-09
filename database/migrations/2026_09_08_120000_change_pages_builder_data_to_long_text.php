<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE pages MODIFY builder_data LONGTEXT DEFAULT NULL');
            DB::statement('ALTER TABLE page_revisions MODIFY builder_data LONGTEXT DEFAULT NULL');
        } else {
            Schema::table('pages', function (Blueprint $table) {
                $table->longText('builder_data')->nullable()->change();
            });
            Schema::table('page_revisions', function (Blueprint $table) {
                $table->longText('builder_data')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE pages MODIFY builder_data LONGTEXT DEFAULT NULL CHECK (json_valid(`builder_data`))');
            DB::statement('ALTER TABLE page_revisions MODIFY builder_data LONGTEXT DEFAULT NULL CHECK (json_valid(`builder_data`))');
        } else {
            Schema::table('pages', function (Blueprint $table) {
                $table->json('builder_data')->nullable()->change();
            });
            Schema::table('page_revisions', function (Blueprint $table) {
                $table->json('builder_data')->nullable()->change();
            });
        }
    }
};
