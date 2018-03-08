<?php

namespace app\helpers;
use app\models\Article;
class ArticleHelper
{
    public static function getArticles()
    {
        static $data = null;
        if ($data === null) {
            $data = Article::find()
                ->select('title')
                ->indexBy('id')
                ->asArray()
                ->column();
            asort($data);
        }
        return $data;
    }
}