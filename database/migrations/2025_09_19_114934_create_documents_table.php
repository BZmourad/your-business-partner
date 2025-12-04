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
        Schema::create('document_names', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->unique();
            $table->foreignId('request_id')->nullable()->constrained('requests')->onDelete('cascade');
            $table->integer('type')->default(1);
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_required')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_answered')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->string('objet')->nullable();
            $table->integer('prix')->nullable();
            $table->integer('tva')->nullable();
            $table->date('date_emission')->nullable();
            $table->date('date_validite')->nullable();
            $table->longText('delai')->nullable();
            $table->longText('conditions_paiement')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('document_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('is_visible')->default(true);
            $table->longText('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('document_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->nullable()->constrained('documents')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('has_view')->default(true);
            $table->boolean('has_delete')->default(true);
            $table->boolean('has_download')->default(true);
            $table->boolean('has_upload_files')->default(true);
            $table->boolean('has_send_by_email')->default(true);
            $table->boolean('has_comment')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_permissions');
        Schema::dropIfExists('document_comments');
        Schema::dropIfExists('documents');
    }
};
