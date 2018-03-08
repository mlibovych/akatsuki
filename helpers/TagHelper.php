<?php

namespace app\helpers;
use app\models\Tag;
class TagHelper
{
    public static function getTags()
    {
        static $data = null;
        if ($data === null) {
            $data = Tag::find()
                ->select('title')
                ->indexBy('id')
                ->asArray()
                ->column();
            asort($data);
        }
        return $data;
    }
}