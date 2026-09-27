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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('regular_percentage');
            $table->unsignedTinyInteger('vip_percentage');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE discounts ADD CONSTRAINT chk_regular_percentage CHECK (regular_percentage >= 0 AND regular_percentage <= 100)');
        DB::statement('ALTER TABLE discounts ADD CONSTRAINT chk_vip_percentage CHECK (vip_percentage >= 0 AND vip_percentage <= 100)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
