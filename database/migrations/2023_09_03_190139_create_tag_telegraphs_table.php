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
        Schema::create('tag_telegraphs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('telegraph_id');
            $table->unsignedBigInteger('tag_id');

            $table->index('telegraph_id', 'telegraph_tag_telegraph_idx');
            $table->index('tag_id', 'telegraph_tag_tag_idx');
            $table->foreign('telegraph_id', 'telegraph_tag_telegraph_fk')->on('telegraph_text')->references('id')->onDelete('cascade');;
            $table->foreign('tag_id', 'telegraph_tag_tag_fk')->on('tags')->references('id')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_telegraphs');
    }
};
