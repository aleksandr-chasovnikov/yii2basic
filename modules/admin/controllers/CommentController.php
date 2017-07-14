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

    // public function actionIndex()
    // {
    //     $comments = Comment::find()->orderBy('id desc')->all();

    //     return $this->render('index', compact('comments'));
        
    // }

    // public function actionDelete($id)
    // {
    // 	echo 'hello';die;
    // 	$comment = Comment::findOne($id);

    // 	if ($comment->delete()) {
    // 		return $this->redirect(['comment/index']);
    // 	}
    // }

}
