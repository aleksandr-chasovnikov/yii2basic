<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * 
 */
class CommentForm extends Model
{
    public $name;
    public $email;
    public $comment;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    /**
     * 
     * @return
     */
    public function saveComment($article_id)
    {       
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = \Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 1;
        $comment->date = date('Y-m-d');

        dd($comment);

        return $comment->save();
    }
}
