<?php

namespace app\controllers;

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

}
