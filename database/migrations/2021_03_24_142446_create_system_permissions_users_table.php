<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemPermissionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_permissions_users', function (Blueprint $table) {
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onDelete('cascade');

            $table->foreignId('system_permission_id')
                    ->constrained('system_permissions')
                    ->onDelete('cascade');

            $table->primary(['system_permission_id', 'user_id']);

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
        Schema::dropIfExists('system_permissions_users');
    }
}
