<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('projects')) {
            return;
        }

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('slug')->nullable();
            $table->string('category', 50)->index();
            $table->json('location')->nullable();
            $table->string('client')->nullable();
            $table->string('completion_year', 50)->nullable();
            $table->json('summary')->nullable();
            $table->json('content')->nullable();
            $table->string('image_url', 1000)->nullable();
            $table->string('banner_url', 1000)->nullable();
            $table->json('gallery')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
