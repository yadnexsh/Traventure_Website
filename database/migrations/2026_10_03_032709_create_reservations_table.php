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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_record_id')->constrained('customer_records')->cascadeOnDelete();
            $table->foreignId('departure_id')->constrained('departures')->cascadeOnDelete();
            $table->string('status')->default('Draft');
            $table->string('payment_status')->default('Unpaid');
            $table->integer('price_snapshot')->unsigned(); // money in integer units (paise)
            $table->timestamps();
        });
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE reservations ADD CONSTRAINT reservations_price_snapshot_check CHECK (price_snapshot >= 0)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
