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
        Schema::create('collections_images', function (Blueprint $table) {
            $table->primary(array('collections_id', 'images_id'));
            $table->uuid('collections_id');
            $table->index('collections_id');
            $table->foreign('collections_id')->references('id')->on('collections')->onDelete('cascade');
            $table->uuid('images_id');
            $table->index('images_id');
            $table->foreign('images_id')->references('id')->on('images')->onDelete('cascade');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections_images');
    }
};
