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
        Schema::create('user_employments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('company')->foreign('company')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('organization')->foreign('organization')->references('id')->on('organizations')->onDelete('cascade');
            $table->unsignedBigInteger('job_position')->foreign('job_position')->references('id')->on('job_positions')->onDelete('cascade');
            $table->string('job_level');
            $table->string('employment_status');
            $table->unsignedBigInteger('branch')->foreign('branch')->references('id')->on('branches')->onDelete('cascade');
            $table->date('join_date');
            $table->date('sign_date');
            $table->unsignedBigInteger('grade')->foreign('grade')->references('id')->on('grades')->onDelete('cascade');
            $table->unsignedBigInteger('class')->foreign('class')->references('id')->on('classes')->onDelete('cascade');
            $table->unsignedBigInteger('approval_line')->foreign('approval_line')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('approval_manager')->foreign('approval_manager')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_employments');
    }
};
