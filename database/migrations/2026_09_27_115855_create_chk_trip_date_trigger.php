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
        DB::unprepared('
            CREATE TRIGGER check_event_date_before_insert
            BEFORE INSERT ON trips
            FOR EACH ROW
            BEGIN
                IF NEW.departure_time <= NOW() THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Error: departure_date must be in the future";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chk_trip_date_trigger');
    }
};
