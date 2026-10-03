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
        Schema::create('departures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trek_id')->constrained('treks')->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('total_capacity')->unsigned();
            $table->integer('unused_offline_reserved_capacity')->unsigned()->default(0);
            $table->string('status')->default('scheduled');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE departures ADD CONSTRAINT departures_total_capacity_check CHECK (total_capacity >= 0)');
        DB::statement('ALTER TABLE departures ADD CONSTRAINT departures_unused_offline_reserved_capacity_check CHECK (unused_offline_reserved_capacity >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departures');
    }
};
