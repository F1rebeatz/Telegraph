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
        Schema::create('telegraph_text', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->string('text');
            $table->string('author');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->index('category_id', 'model_category_idx');
            $table->foreign('category_id', 'post_category_fk')->on('categories')->references('id');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegraph_text');
    }
};
