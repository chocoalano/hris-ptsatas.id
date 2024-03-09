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
        Schema::create('user_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('agency', 100);
            $table->string('level', 100);
            $table->string('status', 100);
            $table->date('start');
            $table->date('finish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_education');
    }
};
