<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\TagHelper;
use app\helpers\ArticleHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tag_id')->dropDownList(TagHelper::getTags(), ['prompt' => '...']) ?>

    <?= $form->field($model, 'article_id')->dropDownList(ArticleHelper::getArticles(), ['prompt' => '...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
