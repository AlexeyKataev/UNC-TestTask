<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', TRUE, TRUE);
            $table->integer('user_role_id', FALSE, TRUE);
            $table->foreign('user_role_id')
                ->references('id')
                ->on('user_roles');
            $table->string('api_access_token', 50)->unique()->nullable();
            $table->string('email', 100)->unique();
            $table->string('second_name', 50)->nullable();
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->boolean('consent_to_the_processing_of_personal_data')
                ->default(FALSE);
            $table->rememberToken();
            $table->timestamps();
            $table->engine = "INNODB";
            $table->charset = "utf8";
            $table->collation = "utf8_general_ci";
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE users comment "Таблица пользователей"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
