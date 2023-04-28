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
        Schema::table('nices', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable(false)->change();
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->unique(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nices', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable(true)->change();
            $table->unsignedBigInteger('user_id')->nullable(true)->change();
            $table->dropUnique(['user_id', 'post_id']);
        });
    }
};
