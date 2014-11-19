<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel backend\models\article\ArticleSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <p><?= Html::a('Добавить статью', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <?php Pjax::begin([
        'timeout'         => 5000,
        'enablePushState' => false,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'       => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    return $model->statusText;
                }
            ],
            [
                'attribute' => 'id_category',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->category->name, ['article-category/view', 'id' => $model->id_category]);
                }
            ],
            [
                'attribute' => 'id_created_user',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->createdUser->username, ['/user/view', 'id' => $model->id_created_user]);
                }
            ],
            [
                'header' => '<span class="glyphicon glyphicon-comment"></span>',
                'value' => function($model) {
                    return $model->commentsCount;
                }
            ],
            'id_article',
            ['class'    => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>