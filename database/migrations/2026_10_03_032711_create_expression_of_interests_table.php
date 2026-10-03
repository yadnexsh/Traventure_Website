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
        Schema::create('expression_of_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id')->constrained('departures')->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->boolean('consent_status')->default(false);
            $table->timestamps();
            
            $table->unique(['departure_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expression_of_interests');
    }
};
