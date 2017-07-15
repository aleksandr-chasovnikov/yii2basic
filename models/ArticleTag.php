<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель для связи тэг-пост
 *
 * @property integer $tag_id идентификатор тэга
 * @property integer $article_id идентификатор поста, к которому принадлежит тэг
 *
 * @property Article $article пост
 * @property Tag $tag тэг
 */
class ArticleTag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'article_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'tag_id' => Yii::t('backend', 'Tag ID'),
            'article_id' => Yii::t('backend', 'Post ID'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Post::className(), ['id' => 'article_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
