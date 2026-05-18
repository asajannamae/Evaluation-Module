<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable()->after('id');
            $table->foreignId('rubric_id')->nullable()->after('booking_id')->constrained()->nullOnDelete();
            $table->string('defense_stage', 64)->nullable()->after('type');
            $table->json('authors')->nullable()->after('defense_stage');
            $table->string('department')->nullable()->after('authors');
            $table->unsignedSmallInteger('max_score')->default(100)->after('department');
            $table->decimal('aggregate_score', 8, 2)->nullable()->after('max_score');
            $table->decimal('aggregate_percent', 6, 2)->nullable()->after('aggregate_score');
            $table->string('decision', 120)->nullable()->after('aggregate_percent');
            $table->date('result_date')->nullable()->after('decision');
        });
    }

    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['rubric_id']);
            $table->dropColumn([
                'booking_id',
                'rubric_id',
                'defense_stage',
                'authors',
                'department',
                'max_score',
                'aggregate_score',
                'aggregate_percent',
                'decision',
                'result_date',
            ]);
        });
    }
};
