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
        Schema::create('project_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('createdby')->foreign('createdby')->references('id')->on('users')->onDelete('cascade');
            $table->string('name', 100);
            $table->text('overview', 'longtext');
            $table->float('budget', 10, 2);
            $table->date('start_date');
            $table->date('due_date');
            $table->decimal('progress', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_management');
    }
};
