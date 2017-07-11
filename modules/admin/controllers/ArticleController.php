<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ImageUpload;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use app\models\Category;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends AdminBaseController
{
    /**
     * Список всех записей
     * @return mixed
     */
    public function actionIndex()
    {
        return parent::actionIndex( new ArticleSearch() );
    }

    /**
     * Показать одну запись.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return parent::actionView( new Article, $id);
    }

    /**
     * Создать или обновить запись
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        return parent::actionSave( new Article, $id);
    }

    /**
     * Удалить запись
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return parent::actionDelete(new Article, $id);
    }

    /**
     * Загружает картинки
     */
    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost) {

            //вытаскиваем данные из БД
            $article = $this->findModel(new Article, $id);

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
        $article = $this->findModel(new Article, $id);

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

}
