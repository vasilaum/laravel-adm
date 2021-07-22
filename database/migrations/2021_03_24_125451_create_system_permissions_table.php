<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('url_action')->comment("Use comma (,) to put multiple URL");

            $table->enum('http_method', [
                'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH',
                'HEAD', 'CONNECT', 'TRACE'
            ])->default('GET');

            $table->foreignId('system_module_id')
                    ->constrained('system_modules')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('system_permissions');
    }
}
