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
        Schema::create('units_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('amenities_id')->unsigned();
            $table->unsignedBiginteger('units_id')->unsigned();
            $table->foreign('amenities_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units_amenities');
    }
};
