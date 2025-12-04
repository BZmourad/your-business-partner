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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->unique();
            // 🔹 Informations personnelles
            $table->enum('partner_type', ['particulier', 'entreprise'])->default('particulier');
            $table->string('company_name')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->enum('gender', ['homme', 'femme'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            
            // 🔹 Identité officielle
            $table->enum('id_type', ['cin', 'passport', 'other'])->nullable();
            $table->string('id_type_other')->nullable();
            $table->string('id_number')->nullable()->unique();
            $table->date('id_issue_date')->nullable();
            $table->string('id_issue_place')->nullable();
            $table->date('id_expiry_date')->nullable();
            
            // 🔹 Informations professionnelles
            $table->string('profession')->nullable();
            $table->string('job_title')->nullable();
            $table->string('employer')->nullable();
            $table->text('work_address')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('activity')->nullable();
            
            // 🔹 Informations fiscales
            $table->string('tax_id')->nullable()->unique();
            $table->string('tax_regime')->nullable();
            $table->string('commerce_register_number')->nullable();
            $table->string('business_sector')->nullable();
            $table->timestamps();
        });

        Schema::create('partner_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_contacts');
        Schema::dropIfExists('partners');
    }
};
