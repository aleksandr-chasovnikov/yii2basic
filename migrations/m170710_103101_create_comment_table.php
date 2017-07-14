<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170710_103101_create_comment_table extends Migration
{
    /**
     * Создание таблицы
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'status' => $this->integer(),
            'date' => $this->date(),
        ]);

        // создает индекс для user_id
        $this->createIndex(
            'idx-comment-user_id',
            'comment',
            'user_id'
        );

        $this->addForeignKey(
            'fk-comment-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // создает индекс для article_id
        $this->createIndex(
            'idx-comment-article_id',
            'comment',
            'article_id'
        );

        $this->addForeignKey(
            'fk-comment-article_id',
            'comment',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * Откат таблицы
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
