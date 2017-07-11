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

abstract class AdminBaseController extends Controller
{
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex($searchModel)
    {
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
    public function actionView($model_empty, $id)
    {
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
    public function actionSave($model_empty, $id = null)
    {
    	if ( !Yii::$app->request->post() && !empty($id)) {

	        $model = $this->findModel($model_empty, $id);

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
    public function findModel($model_empty, $id)
    {
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
    public function actionDelete($model_empty, $id)
    {
        $this->findModel($model_empty, $id)->delete();

        return $this->redirect(['index']);
    }

}
