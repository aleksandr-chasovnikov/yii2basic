<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170710_102905_create_article_table extends Migration
{
    /**
     * Создание таблицы
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'content' => $this->text(),
            'date' => $this->date(),
            'image' => $this->string(),
            'viewed' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
    }

    /**
     * Откат таблицы
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
