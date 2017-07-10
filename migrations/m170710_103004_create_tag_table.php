<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m170710_103004_create_tag_table extends Migration
{
    /**
     * Создание таблицы
     */
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * Откат таблицы
     */
    public function down()
    {
        $this->dropTable('tag');
    }
}
