<?php

Yii::import('zii.widgets.CPortlet');
 
class TagCloud extends CPortlet
{
    public $title='Tags';
    public $maxTags=20;
 
    protected function renderContent()
    {
        $tags=Tag::model()->findTagWeights($this->maxTags);
 
        foreach($tags as $tag=>$weight)
        {
            $link=Html::a(Html::encode($tag), array('post/index','tag'=>$tag));
            echo Html::tag('span', array(
                'class'=>'tag',
                'style'=>"font-size:{$weight}pt",
            ), $link)."\n";
        }
    }
}