<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\Tag;
use app\models\Article;
use app\models\ArticleTag;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function($rule, $action) {

                        throw new \yii\web\NotFoundHttpException();
                    },
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,                        
                        'matchCallback' => function($rule, $action) {
                            
                                return \Yii::$app->user->identity->isAdmin;
                            }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['article'],
                ],
            ],
        ];
    }
    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $posts = Article::find()->with('tags')->all();

        foreach ($posts as $post) {
            $article[] = $post->title;
        }
        // var_dump($article);die;

        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'article' => $article,
        ]);
    }
    /**
     * Displays a single Tag model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);

        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }

        // $article = Article::findOne($id);
         
        //  if ( Yii::$app->request->post() ) {

        //     $article->addTagNames('bar, baz');
        //  }

        // // Добавление тегов строкой
         
        // // Добавление тегов массивом
        // $article->addTagNames(['bar', 'baz']);
    }
    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);

        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}