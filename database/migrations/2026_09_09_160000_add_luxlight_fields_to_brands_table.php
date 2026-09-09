<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('country')->nullable()->after('name');
            $table->string('showcase_image', 1000)->nullable()->after('image_url');
            $table->string('website_url', 1000)->nullable()->after('showcase_image');
            $table->boolean('is_featured')->default(false)->after('is_active')->index();
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['country', 'showcase_image', 'website_url', 'is_featured']);
        });
    }
};
