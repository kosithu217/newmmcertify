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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('uniqueId')->unique(); // Random 6-digit unique ID
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->string('name'); // Name
            $table->string('logo'); // File name for logo
            $table->string('certificate'); // File name for certificate
            $table->text('description')->nullable(); // Description (nullable)
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint optional
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
