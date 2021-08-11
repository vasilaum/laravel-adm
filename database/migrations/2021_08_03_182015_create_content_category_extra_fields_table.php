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
            $table->string('field_id', 100)->nullable();
            $table->string('placeholder', 100)->nullable();
            $table->string('label', 100)->nullable();
            $table->string('mask', 100)->nullable();
            $table->string('options', 200)->nullable()->comment("If type is select, radio or ck, save the options as json object array");

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
