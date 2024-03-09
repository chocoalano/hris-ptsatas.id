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
        Schema::create('project_members', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_management_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_management_id')->references('id')->on('project_management')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};
