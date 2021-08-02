<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_images', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->nullable();
            $table->string('path', 200);
            $table->integer('order')->nullable(false)->default(99);
            $table->foreignId('content_id')->constrained('contents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_images');
    }
}
