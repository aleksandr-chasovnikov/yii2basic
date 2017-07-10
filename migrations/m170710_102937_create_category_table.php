<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170710_102937_create_category_table extends Migration
{
    /**
     * Создание таблицы
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * Откат таблицы
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
