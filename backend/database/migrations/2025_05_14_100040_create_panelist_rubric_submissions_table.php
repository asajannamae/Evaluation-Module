<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panelist_rubric_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status', 32)->default('draft');
            $table->json('scores');
            $table->json('comments')->nullable();
            $table->text('general_comments')->nullable();
            $table->decimal('total_score', 10, 2)->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->unique(['evaluation_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panelist_rubric_submissions');
    }
};
