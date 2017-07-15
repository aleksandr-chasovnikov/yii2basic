<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Модель тэгов.
 *
 * @property integer $id
 * @property string $title название тэга
 *
 * @property TagArticle[] $tagArticles
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'title' => Yii::t('admin', 'Title'),
        ];
    }

    /**
     * Возвращает посты, относящиеся к тегу.
     * @return ActiveQuery
     */
    public function getArticleTag()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * Возвращает опубликованные посты, связанные с тэгом.
     * @return ActiveDataProvider
     */
    public function getPublishedArticles()
    {
        return new ActiveDataProvider([
            'query' => $this->getArticleTag()
                ->alias('tp')
                ->leftJoin(Article::tableName() . ' a', 'a.id = tp.article_id')
                ->where(['status' => 1])
                ->orderBy('date')
        ]);
    }

    /**
     * Возвращает модель тэга.
     * @param int $id
     * @return Tag
     * @throws NotFoundHttpException
     */
    public function getTag($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Article does not exist.');
        }
    }
}
