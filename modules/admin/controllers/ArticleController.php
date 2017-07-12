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
        $selectedCategory = $article->category->id;

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
}
