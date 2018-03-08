<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_id',
            'tag_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
