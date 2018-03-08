<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(!empty($comments)):?>

        <table class="table">
            <thead >
            <tr bgcolor="#f0f8ff">
                <td>№</td>
                <td>Author</td>
                <td>Article ID</td>
                <td align="center">Text</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </thead>

            <tbody>
            <?php foreach($comments as $comment):?>
                <tr>
                    <td width="50"><?= $comment->id?></td>
                    <td width="100"><?= $comment->user->name?>(id - <?= $comment->user->id?>)</td>
                    <td width="50"><a href="<?= Url::toRoute(['article/view','id' => $comment->article->id]);?>"><?= $comment->article->id?></a></td>
                    <td ><?= $comment->text?></td>
                    <td width="100">
                        <?php if($comment->isAllowed()):?>
                        <th width=" 100"><a class="btn btn-warning" href="<?= Url::toRoute(['comment/disallow', 'id'=>$comment->id]);?>">Disallow</a></th>
                        <?php else:?>
                        <th width=" 100"><a class="btn btn-success" href="<?= Url::toRoute(['comment/allow', 'id'=>$comment->id]);?>"> Allow </a></th>
                        <?php endif?>
                        <th width=" 100"><a class="btn btn-danger" href="<?= Url::toRoute(['comment/delete', 'id' => $comment->id]); ?>">Delete</a></th>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    <?php endif;?>
</div>
