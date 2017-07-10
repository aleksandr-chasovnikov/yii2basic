<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170710_103045_create_user_table extends Migration
{
    /**
     * Создание таблицы
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string()->defaultValue(null),
            'password' => $this->string(),
            'isAdmin' => $this->string()->defaultValue(null),
            'photo' => $this->string(),
        ]);
    }

    /**
     * Откат таблицы
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
