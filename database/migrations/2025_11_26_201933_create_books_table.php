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
        Schema::create('books', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title', 255)->index();
            
            $table->unsignedBigInteger('author_id')->index();
            $table->unsignedBigInteger('category_id')->index();

            $table->date('release_date')->index();
            $table->string('price_huf')->index();
            $table->timestamps();
            
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
