<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('lang')->default('fr');
            $table->timestamp('last_seen')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('type')->default('admin');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->enum('gender', ['homme', 'femme'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->enum('id_type', ['cin', 'passport', 'other'])->nullable();
            $table->string('id_type_other')->nullable();
            $table->string('id_number')->nullable()->unique();
            $table->date('id_issue_date')->nullable();
            $table->string('id_issue_place')->nullable();
            $table->date('id_expiry_date')->nullable();
            $table->string('job_title')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
