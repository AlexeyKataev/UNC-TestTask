<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement(
            'CREATE TABLE user_actions (
                  user_id int(10) UNSIGNED NOT NULL,
                  action_id int(10) UNSIGNED NOT NULL,
                  PRIMARY KEY (user_id, action_id),
                  CONSTRAINT FK_user_actions_actions_id FOREIGN KEY (action_id)
                  REFERENCES actions (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                  CONSTRAINT FK_user_actions_users_id FOREIGN KEY (user_id)
                  REFERENCES users (id) ON DELETE RESTRICT ON UPDATE RESTRICT
            )
            ENGINE = INNODB
            CHARACTER SET utf8
            COLLATE utf8_general_ci
            COMMENT = "Участие пользователя в акции";'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_actions');
    }
}
