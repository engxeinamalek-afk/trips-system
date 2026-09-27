<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BookingStatus;
use App\Enums\BookingType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->restrictOnDelete();

            $table->string('customer_name');
            $table->string('customer_phone');

            $table->enum('status' , array_column(BookingStatus::cases() , 'value'))
                  ->default(BookingStatus::IN_PROGRESS->value);

            $table->enum('type' , array_column(BookingType::cases() , 'value'))
                  ->default(BookingType::NORMAL->value); 

            $table->decimal('final_price');
            $table->unsignedTinyInteger('seats_count');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
