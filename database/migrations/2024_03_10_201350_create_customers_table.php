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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('createdby')->foreign('createdby')->references('id')->on('users')->onDelete('cascade');
            $table->string('fullname', 100);
            $table->text('address', 'longtext');
            $table->string('company', 100);
            $table->string('type', 100);
            $table->string('phone', 100);
            $table->string('email', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
