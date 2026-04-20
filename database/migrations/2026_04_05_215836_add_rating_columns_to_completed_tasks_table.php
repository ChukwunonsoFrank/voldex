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
        Schema::table('completed_tasks', function (Blueprint $table) {
            $table->string('rating')->after('task_image_path');
            $table->string('rating_id')->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('completed_tasks', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('rating_id');
        });
    }
};
