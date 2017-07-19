<?php

namespace app\modules\admin\controllers;

use Yii;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends \app\controllers\BaseController
{
    /**
     * Задает имя модели
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct(__CLASS__, $id, $module, $config);
    }

}
