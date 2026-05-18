<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rubric_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rubric_id')->constrained()->cascadeOnDelete();
            $table->string('criterion_key', 64);
            $table->string('name');
            $table->unsignedSmallInteger('max_points');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['rubric_id', 'criterion_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rubric_criteria');
    }
};
