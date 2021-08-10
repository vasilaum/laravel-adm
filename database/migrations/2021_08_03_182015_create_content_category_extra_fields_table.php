<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategoryExtraFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_category_extra_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);

            $table->enum('type', [
                'number', 'text', 'textarea', 'date', 'select', 'radio',
                'checkbox', 'email'
            ])->default('text');

            $table->foreignId('category_id')->constrained('content_categories')->onDelete('cascade');
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
        Schema::dropIfExists('content_category_extra_fields');
    }
}
