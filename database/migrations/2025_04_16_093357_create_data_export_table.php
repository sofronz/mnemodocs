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
        Schema::create('md_data_export', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->text('file_path')->nullable();
            $table->uuid('exported_by');
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('exported_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_data_export');
    }
};
