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
        Schema::create('databases', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('name_kh')->nullable();
            $table->string('image')->nullable();
            $table->string('client_side_image')->nullable();
            $table->string('link')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databases');
    }
};