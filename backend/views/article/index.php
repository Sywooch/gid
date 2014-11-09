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
        'timeout'         => 2000,
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
                    return "<span class='label " . $model->statusClass . "'>" . $model->statusText . '</span>';
                }
            ],
            [
                'attribute' => 'id_category',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->category->name, ['article-category/view', 'id' => $model->id_category]);
                }
            ],
            'id_article',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>