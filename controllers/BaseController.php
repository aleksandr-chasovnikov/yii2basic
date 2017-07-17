<?php

namespace app\controllers;

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
use app\models\CategorySearch;
use app\models\Tag;
use app\models\TagSearch;

abstract class BaseController extends Controller
{
    // Содержит имя модели
    public $model;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Задает имя модели от имени контроллера
     */
    public function __construct($controller, $id, $module, $config = [])
    {
        $name_model =  explode('Controller', baseName($controller));

        $this->model = 'app\models\\' . $name_model[0];

        parent::__construct($id, $module, $config);
    }

    /**
     * Список записей
     * @return mixed
     */
    public function actionIndex($categories = null)
    {
        $nameModel = $this->model . 'Search';

        $searchModel = new $nameModel;
        
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams);

        return $this->render( 'index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);

    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model_empty = new $this->model;

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Сохраняет или изменяет запись
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate( $categories = null, $id = null)
    {
        // Если $_POST пуст и не пусто $id, то получаем выборку из БД
    	if ($id) {

	        $model = $this->findModel($id);

	    } else {

	    	$model = new $this->model;
	    }

        if ( $model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model', 'categories'));        
    }

    /**
     * Выборка из БД
     */
    public function findModel( $id)
    {
        $model_empty = $this->model;

        if (!empty($model = $model_empty::findOne($id)) ) {

            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена!');

    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete( $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

}
