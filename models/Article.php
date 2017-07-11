<?php

namespace app\models;

use Yii;
use app\models\Category;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property integer $viewed
 * @property integer $user_id
 * @property integer $status
 * @property integer $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content'], 'string'],
            [['title', 'description', 'content'], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            // [['date'], 'safe'], // не проверять - безопасные данные
            [['viewed', 'user_id', 'status', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public function saveImage($filename)
    {
        $this->image = $filename;

        return $this->save(false); //отключили валидацию
    }

    public function getImage()
    {
        return $this->image ? '/uploads/' . $this->image : '/no-image.png';
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload;
        $imageUploadModel = deleteCurrentImage($this->image);
    }

    /**
     * Запускается перед удалением статьи
     */
    public function beforeDelete()
    {
        $imageModel = new ImageUpload;
        $imageModel->deleteCurrentImage($this->image);

        return parent::beforeDelete();
    }

    /**
     * Связывание с таблицей 'category'
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Сохраняет категорию в БД
     */
    public function saveCategory($category_id)
    {
        // Выборак из БД
        $category = Category::findOne($category_id);

        if (!empty($category)) {

            //сохраняем значение в 'article' со связью с 'category'
            $this->link('category', $category);
            
            return true;

        }

    }
}
