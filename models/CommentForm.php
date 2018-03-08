<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

class CommentForm extends Model
{
    public $comment;
    
    public function rules()
    {
        return [
            [['comment'], 'required'],
        ];
    }

    public function saveComment($article_id)
    {
        $comment = new Comment;
        $comment->text = Html::encode($this ->comment);
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;
        $comment->date = date('Y-m-d H-i-s');
        return $comment->save();

    }
}