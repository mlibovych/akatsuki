<?php
/**
 * Created by PhpStorm.
 * User: KurokoNoBaske
 * Date: 16.01.2018
 * Time: 17:55
 */

namespace app\models;

use Yii;
use yii\base\Model;


class SearchForm extends Model
{
    public $q;

    public function rules()
    {
        return[
            ['q','string'],
        ];
    }

}