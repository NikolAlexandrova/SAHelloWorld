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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('articlesID');
            $table->dateTime('published_on')->nullable();
            $table->string('title');
            $table->text('body');
            $table->string('articles_img')->nullable();
            $table->boolean('is_posted')->default(false);
            $table->dateTime('scheduled_post')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
