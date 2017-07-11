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
     * Задает имя модели
     */
    public function __construct($className, $id, $module, $config = [])
    {
        $name_model =  explode('C', baseName($className));

        $this->model = 'app\models\\' . $name_model[0];

        parent::__construct($id, $module, $config);
    }

    /**
     * Список записей
     * @return mixed
     */
    public function actionIndex()
    {
        $nameModel = $this->model . 'Search';

        $searchModel = new $nameModel;

        $dataProvider = $searchModel->search( Yii::$app->request->queryParams);

        return $this->render( 'index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
            'model' => $this->findModel($model_empty, $id),
        ]);
    }

    /**
     * 
     * @param integer $view
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate( $id = null)
    {
    	if ( !Yii::$app->request->post() && !empty($id)) {

	        $model = $this->findModel( $id);

	    } else {

	    	$model = $model_empty;
	    }

        if ( $model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);

        } else {

            return $this->render('update', compact('model'));
        }
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

        return $this->redirect(['index']);
    }

}
