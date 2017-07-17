<?php

namespace app\models;

use Yii;
use app\models\Category;
use app\models\Comment;
use app\models\Tag;
use yii\helpers\ArrayHelper;
use creocoder\taggable\TaggableBehavior;

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
            [['date', 'tags'], 'safe'], // не проверять - безопасные данные
            [['viewed', 'user_id', 'status', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            ['tagNames', 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            TaggableBehavior::className(),
        ];
    }
 
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
 
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    // public function afterSave($insert, $changedAttributes)
    // {
    //     ArticleTag::deleteAll(['id' => $this->id]);
    //     $values = [];
    //     foreach ($this->tags as $id) {
    //         $values[] = [$this->id, $id];
    //     }
    //     self::getDb()->createCommand()
    //         ->batchInsert(ArticleTag::tableName(), ['id', 'tag_id'], $values)->execute();
     
    //     parent::afterSave($insert, $changedAttributes);
    // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID статьи',
            'title' => 'Заголовок',
            'description' => 'Краткое описание',
            'content' => 'Текст',
            'date' => 'Дата',
            'image' => 'Изображение',
            'viewed' => 'Количество просмотров',
            'user_id' => 'ID автора',
            'status' => 'Статус',
            'category_id' => 'ID категории',
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

    public function getImage($image = null)
    {
        if ($image) {

            return $image ? '/uploads/' . $image : '/no-image.png';
        }
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

        Comment::deleteAll(['id' => $this->category_id]);

        return parent::beforeDelete();
    }

    /**
     * Связывание с таблицей 'category'('id' в Category)
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Связывание с таблицей 'user'('id' в User)
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Связывание с таблицей 'category'('article_id' - в модели Comment)
     */
    public function getComment()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
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

    /**
     * получает выбранныый тэг
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedTags()
    {
       $selectedTags = $this->getTags()->select('id')->asArray()->all();

       return ArrayHelper::getColumn($selectedTags, 'id');
    }

    /**
     * Сохраняет тэги
     */
    public function saveTags($tags)
    {
        if ( is_array($tags)) {

            // удаляет текущий тэг
            ArticleTag::deleteAll(['article_id' => $this->id]);

            foreach ($tags as $tag_id) {

                $tag = Tag::findOne($tag_id);

                // Устанавливает взаимосвязь между двумя моделями
                $this->link('tags', $tag);
            }
        }
    }

    /**
     * Получить форматированную дату
     */
    public function getDate($date = null)
    {
        if ($date) {
            $this->date = $date;
        }

        Yii::$app->formatter->locale = 'ru_RU';

        if ( Yii::$app->formatter->asDate($this->date) ) {

            return Yii::$app->formatter->asDate($this->date);
        }

        return false;
    }

    /**
     * Данные для сайдбара
     */
    public static function getSideBar()
    {
        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $recent = Article::find()->orderBy('date desc')->limit(3)->all();

        // попытка оптимизации: один подготовленный запрос для разных параметров
        // $command = Yii::$app->db->createCommand('SELECT * FROM article ORDER BY :order DESC LIMIT 3')

        //         ->bindParam(':order', $order);

        // $order = 'viewed';
        // $popular = $command->queryAll();

        // $order = 'date';
        // $recent = $command->queryAll();

        // $categories = Category::find()->with('articles')->all();
        $categories = Category::find()->all();

        return compact('popular', 'recent', 'categories');
    }

    /**
     * Счетчик просмотров
     */
    public function viewedCounter()
    {
        $this->viewed += 1;

        return $this->save(false); //false - без валидации
    }
}
