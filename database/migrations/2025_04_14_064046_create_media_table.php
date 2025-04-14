<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('md_media', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_name');
            $table->text('file_path');
            $table->string('mime_type');
            $table->string('file_size');
            $table->boolean('status')->default(true);
            $table->json('metadata')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_media');
    }
};
