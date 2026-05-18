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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('research_title');
            $table->json('members');
            $table->string('adviser_name');
            $table->string('department');
            $table->date('requested_date');
            $table->string('requested_time');
            $table->string('venue')->nullable();
            $table->string('defense_type')->default('Title Defense');
            $table->string('status')->default('pending');
            $table->json('assigned_panelists')->nullable();
            $table->text('decline_reason')->nullable();
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
