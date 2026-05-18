<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
            $table->string('role_label')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('account_type')->nullable();
            $table->string('status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'role_label',
                'department',
                'position',
                'account_type',
                'status',
            ]);
        });
    }
};
