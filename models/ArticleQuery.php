<?php 

namespace app\models;

use creocoder\taggable\TaggableQueryBehavior;
 
class ArticleQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }
}