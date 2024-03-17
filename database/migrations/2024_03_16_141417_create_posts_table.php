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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('createdby')->foreign('createdby')->references('id')->on('users')->onDelete('cascade');;
            $table->unsignedBigInteger('category_id')->foreign('category_id')->references('id')->on('post_categories')->onDelete('cascade');;
            $table->string('title', 100);
            $table->string('slug');
            $table->string('keywords');
            $table->longText('description');
            $table->longText('content');
            $table->string('tags');
            $table->string('cover_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
