<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->integer('id', TRUE, TRUE);
            $table->string('title', 255)->comment('Заголовок');
            $table->date('date_start')->comment('Дата начала');
            $table->date('date_end')->comment('Дата окончания');
            $table->timestamps();
            $table->engine = "INNODB";
            $table->charset = "utf8";
            $table->collation = "utf8_general_ci";
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE users comment "Акции для пользователей"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
