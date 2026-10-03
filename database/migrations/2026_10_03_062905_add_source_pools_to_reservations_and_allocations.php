<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('booking_source')->default('online');
        });

        Schema::table('seat_allocations', function (Blueprint $table) {
            $table->string('source_pool')->nullable();
        });

        \Illuminate\Support\Facades\DB::table('seat_allocations')->update(['source_pool' => 'online']);
    }

    public function down(): void
    {
        Schema::table('seat_allocations', function (Blueprint $table) {
            $table->dropColumn('source_pool');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('booking_source');
        });
    }
};
