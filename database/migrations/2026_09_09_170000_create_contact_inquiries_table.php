<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable(); // Chức vụ / danh xưng (Architect, Lighting Designer, Project Manager...)
            $table->string('company')->nullable(); // Tên công ty / tổ chức
            $table->string('email')->index();
            $table->string('phone');
            $table->string('enquiry_type')->default('Sales Enquiry')->index(); // Sales Enquiry, Technical Enquiry, Feedback, Other
            $table->text('message');
            $table->string('status')->default('new')->index(); // new, processing, replied, archived
            $table->text('admin_notes')->nullable(); // Ghi chú nội bộ
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};
