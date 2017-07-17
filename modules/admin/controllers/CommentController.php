<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Comment;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends \app\controllers\BaseController
{
    /**
     * Задает имя модели
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct(__CLASS__, $id, $module, $config);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = Comment::findOne($id);

        $article_id = $model->article->id;

		return $this->redirect(['/site/view', 'id' => $article_id]);
    }


}
