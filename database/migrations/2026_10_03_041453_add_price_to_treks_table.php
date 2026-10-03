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
        Schema::table('treks', function (Blueprint $table) {
            $table->integer('price')->unsigned()->default(0);
        });

        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE treks ADD CONSTRAINT treks_price_check CHECK (price >= 0)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE treks DROP CONSTRAINT treks_price_check');
        }
        Schema::table('treks', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
