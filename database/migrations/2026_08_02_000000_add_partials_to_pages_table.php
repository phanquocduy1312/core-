<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('type', 20)->default('page')->after('id')->index();
            $table->string('partial_role', 20)->nullable()->after('type');
            $table->string('header_mode', 10)->default('inherit')->after('published_at');
            $table->foreignId('header_partial_id')->nullable()->after('header_mode')
                ->constrained('pages')->nullOnDelete();
            $table->string('footer_mode', 10)->default('inherit')->after('header_partial_id');
            $table->foreignId('footer_partial_id')->nullable()->after('footer_mode')
                ->constrained('pages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('header_partial_id');
            $table->dropConstrainedForeignId('footer_partial_id');
            $table->dropColumn(['type', 'partial_role', 'header_mode', 'footer_mode']);
        });
    }
};
