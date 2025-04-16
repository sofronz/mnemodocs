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
        Schema::create('md_mediables', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mediable_type');
            $table->uuid('mediable_id');
            $table->uuid('media_id');
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('media_id')->references('id')->on('md_media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_mediables');
    }
};
