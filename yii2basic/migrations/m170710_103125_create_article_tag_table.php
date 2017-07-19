<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m170710_103125_create_article_tag_table extends Migration
{
    /**
     * Создание таблицы
     */
    public function up()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        // создает индекс для user_id
        $this->createIndex(
            'idx-article_tag_article_id',
            'article_tag',
            'article_id'
        );

        $this->addForeignKey(
            'fk-article_tag_article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        // создает индекс для user_id
        $this->createIndex(
            'idx-article_tag_tag_id',
            'article_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-article_tag_tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * Откат таблицы
     */
    public function down()
    {
        $this->dropTable('article_tag');
    }
}
