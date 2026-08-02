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
        Schema::create('sk_items', function (Blueprint $table) {
            $table->id();
            $table->string('gambar'); 
            $table->string('pdf')->nullable();
            $table->timestamp('start_year')->nullable();
            $table->timestamp('end_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_items');
    }
};
