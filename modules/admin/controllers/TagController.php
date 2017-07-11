<?php

namespace app\modules\admin\controllers;

use Yii;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends \app\controllers\BaseController
{
    /**
     * Задает имя модели
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct(__CLASS__, $id, $module, $config);
    }
}
