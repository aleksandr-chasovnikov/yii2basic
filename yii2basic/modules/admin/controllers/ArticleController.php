<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ImageUpload;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Tag;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends \app\controllers\BaseController
{
    /**
     * Задает имя модели
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct(__CLASS__, $id, $module, $config);
    }

    /**
     * 
     */
    public function actionIndex($categories = null)
    {
        // $categories = Category::find()->select('title')->all();

        $categoriesObj = Category::find()->orderBy('title')->all();

        foreach ($categoriesObj as $value) {
            $categories[$value->id] = $value->title;
        }

        return parent::actionIndex($categories);        
    }

    /**
     * Загружает картинки
     */
    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost) {

            //вытаскиваем данные из БД
            $article = $this->findModel($id);

            //загружаеи файл
            $file = UploadedFile::getInstance($model, 'image');

            //готовим к сохранению в БД
            $article->saveImage( $model->uploadFile( $file, $article->image ));

                return $this->redirect(['view', 'id' =>$article->id]);
        }

        return $this->render('image', compact('model'));
    }

    /**
     * Создает выбор категории из списка
     */
    public function actionSetCategory($id)
    {
        // Выборка из БД
        $article = $this->findModel($id);

        // getCategory() == category (особенность Yii2)
        $selectedCategory = $article->category_id;

        // ArrayHelper предоставляет дополнительные функции массива
        // Берет из выборки только 'id', 'title'
        $categories = ArrayHelper::map( Category::find()->all(), 'id', 'title');

        if (Yii::$app->request->isPost) {

            // берем значение из $_POST['category']
            $category = Yii::$app->request->post('category');

            // сохраняет в БД и перенаправляет
            if ( $article->saveCategory($category) ) {
                
                return $this->redirect(['view', 'id' => $article->id]);
                
            }            
        }

        return $this->render('category', compact('article', 'selectedCategory', 'categories'));
    }

    /**
     * 
     */
    public function actionSetTags($id)
    {
        //получает данные из БД
        $article = $this->findModel($id);

        // получает выбранныый тэг
        $selectedTags = $article->getSelectedTags();

        // получает данные тэгов из БД
        $tags = ArrayHelper::map( Tag::find()->all(), 'id', 'title');

        if ( Yii::$app->request->isPost)
        {
            // Вытаскивае данные из $_POST
            $tags = Yii::$app->request->post('tags');
            // Сохраняем данные в БД
            $article->saveTags($tags);

            return $this->redirect(['view', 'id' => $article->id]);
        }

        return $this->render('tags', compact('selectedTags', 'tags'));
    }

    /**
     * Создание записи
     */
    public function actionCreate()
    {
        // $categories = Category::find()->select('title')->all();

        // $categories = (new \yii\db\Query())
        //     ->select(['id', 'title'])
        //     ->from('category')
        //     ->all();

        $categoriesObj = Category::find()->orderBy('title')->all();

        foreach ($categoriesObj as $value) {
            $categories[$value->id] = $value->title;
        }

        $model = new $this->model;
        
        // $tags = new Tag;

        if ( $model->load(Yii::$app->request->post()) && $model->save()) {

            // $count_articles = Category::find()->where(['id' => ])

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model', 'categories')); 
    }

    /**
     * Отключает CSRF-защиту для actionCreate() и др.
     */
    public function beforeAction($action) {

    if ($action->id !== "create" || $action->id !== "set-image") {

        $this->enableCsrfValidation = false; 
    }
        return parent::beforeAction($action);
    }

    /**
     * Редактирование записи
     */
    public function actionUpdate($category = null, $id = null)
    {
        $model = $this->findModel($id);

        $category = (new \yii\db\Query())
            ->select(['title'])
            ->from('category')
            ->where(['id' => $model->category_id])
            ->all();

        $categoriesObj = Category::find()->orderBy('title')->all();
        // $tags = Tag::find()->orderBy('date DESC')->all();

        foreach ($categoriesObj as $value) {
            $categories[$value->id] = $value->title;
        }

        if ( $model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model', 'categories', 'category'));     

    }
}
