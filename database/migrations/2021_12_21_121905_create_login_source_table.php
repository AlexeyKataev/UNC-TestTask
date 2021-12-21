<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $nowTms = new DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        Schema::create('login_source', function (Blueprint $table) use ($nowTmsFormat) {
            $table->integer('id', TRUE, TRUE);
            $table->integer('user_id', FALSE, TRUE);
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->timestamp('tms')->default($nowTmsFormat);
            $table->enum('source', [ 'site', 'android', 'iphone' ])->default('site');
            $table->timestamps();
            $table->engine = "INNODB";
            $table->charset = "utf8";
            $table->collation = "utf8_general_ci";
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE users comment "История авторизаций"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_sources');
    }
}
