<?php

use app\models\Tag;
use yii\helpers\Html;

/**
 * @author Troy <troytft@gmail.com>
 */
class TagCloud extends Widget
{

    public $limit = 20;

    public function run()
    {
        $tags = Tag::model()->findTagWeights($this->limit);
        foreach ($tags as $tag => $weight)
            echo Html::tag('span', array('style' => "font-size:{$weight}pt"), $tag);
    }


}