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
        Schema::create('group_post_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_post_id')->nullable();
            $table->foreign('group_post_id')->references('id')->on('group_post')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_post_post');
    }
};
