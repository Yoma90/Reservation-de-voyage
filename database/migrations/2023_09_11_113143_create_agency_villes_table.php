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
        Schema::create('agency_villes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ville_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('agency_id')->constrained()->onUpdate('cascade');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_villes');
    }
};
