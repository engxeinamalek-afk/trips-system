<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('departure_city_id')->constrained('cities')->restrictOnDelete();
            $table->foreignId('destination_city_id')->constrained('cities')->restrictOnDelete();
            
            $table->dateTime('departure_time');
            $table->unsignedTinyInteger('total_seats');
            $table->unsignedInteger('price');

            $table->foreignId('discount_id')->nullable()->constrained()->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE trips ADD CONSTRAINT chk_different_cities CHECK (departure_city_id <> destination_city_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
