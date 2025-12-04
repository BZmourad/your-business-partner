<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'refused'])->default('pending');
            $table->enum('paid_status', ['unpaid', 'paid'])->default('unpaid');
            $table->longText('notes')->nullable();
            $table->longText('admin_feedback')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('request_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['short_text', 'long_text', 'number', 'date', 'datetime', 'single_select', 'multiple_select'])->nullable();
            $table->json('options')->nullable(); 
            $table->boolean('is_required')->default(false);
            $table->longText('response')->nullable();
            $table->timestamps();
        });
        
        Schema::create('request_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'refused', 'unpaid', 'paid'])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->longText('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('request_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('is_visible')->default(true);
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_status');
        Schema::dropIfExists('request_fields');
        Schema::dropIfExists('requests');
    }
};
