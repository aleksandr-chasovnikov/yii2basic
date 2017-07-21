<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CommentForm;
use app\models\Article;
use app\models\Tag;
use app\models\ArticleTag;
use app\models\Category;
use yii\data\Pagination;

class SiteController extends Controller
{
    // const PAGE_SIZE = 7;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'index', 'view', 'contact', 'comment', 'tags', 'about'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'view', 'contact', 'comment', 'tags', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return Response|string
     */
    public function actionIndex($id = null)
    {
        if ($id) {

            //показ статей по категории
            $query = Article::find()->where(['category_id'=> $id]);
            // Для заголовка списка статей определенной категории
            $categoryOne = Category::findOne($id);

        } else {

            //показ статей без категории
            $query = Article::find();
            $categoryOne = null;
            
        }
            $tags = Tag::find()
                ->asArray()
                ->all();;

        //общее количество статей
        $count = $query->count();

        $pagination = new Pagination([
                        'totalCount' => $count, 
                        'pageSize' => 6
                    ]);

        $articles = $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

        // объединяем в один массив
        $result = Article::getSideBar() + compact(
                        'articles', 
                        'pagination',
                        'categoryOne',
                        'tags'
                    );

        return $this->render('index', $result);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionTags($id)
    {
        if ($id) {

            $articleTag = ArticleTag::find()
                    ->with('tag')
                    ->where(['tag_id' => $id])
                    ->asArray()
                    ->all();


            foreach ($articleTag as $v) {
                $articles[] = Article::find()->where(['id'=> $v['article_id']])->one();
            }

            $categoryOne = null;
            $pagination = null;

            $tags = Tag::find()
                ->asArray()
                ->all();;

        // //общее количество статей
        // $count = $query->count();

        // $pagination = new Pagination([
        //                 'totalCount' => $count, 
        //                 'pageSize' => 6
        //             ]);

        // $articles = $query->offset($pagination->offset)
        //             ->limit($pagination->limit)
        //             ->all();

        // объединяем в один массив
        $result = Article::getSideBar() + compact(
                        'articles', 
                        'pagination',
                        'categoryOne',
                        'tags'
                    );

        } 
        return $this->render('index', $result);
    }

    /**
     * Показывает одну статью
     *
     * @return Response|string
     */
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $article->viewedCounter();

        // comments/getComment() - массив объектов Comment
        $comments = $article->getComment()->where(['status' => 1])->all();

        $commentForm = new CommentForm;

        $result = Article::getSideBar() + compact('article', 'comments', 'commentForm');

        return $this->render('single', $result);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Сохраняет комментарий в БД
     *
     * @return Response|string
     */
    public function actionComment($id)
    {
        $model = new CommentForm();

        if( Yii::$app->request->isPost ) {

            $model->load( Yii::$app->request->post() );

            if( $model->saveComment($id) ) {

                Yii::$app->getSession()->setFlash('comment', 'Сообщение отправлено.');

            return $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
