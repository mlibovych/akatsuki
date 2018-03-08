<?php

namespace app\helpers;
use app\models\Category;
class CategoryHelper
{
    public static function getCategories()
    {
        static $data = null;
        if ($data === null) {
            $data = Category::find()
                ->select('title')
                ->indexBy('id')
                ->asArray()
                ->column();
            asort($data);
        }
        return $data;
    }
}