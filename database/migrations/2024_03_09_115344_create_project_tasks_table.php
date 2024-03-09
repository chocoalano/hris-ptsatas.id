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
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_management_id')->foreign('project_management_id')->references('id')->on('project_management')->onDelete('cascade');
            $table->unsignedBigInteger('createdby')->foreign('createdby')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('assignto')->foreign('assignto')->references('id')->on('users')->onDelete('cascade');
            $table->text('description', 'longtext');
            $table->decimal('progress', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
