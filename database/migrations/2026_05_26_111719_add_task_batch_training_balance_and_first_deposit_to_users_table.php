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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('task_batch')->default(0)->after('task_pole');
            $table->unsignedBigInteger('training_balance')->default(0)->after('balance');
            $table->boolean('has_made_first_deposit')->default(false)->after('training_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['task_batch', 'training_balance', 'has_made_first_deposit']);
        });
    }
};
