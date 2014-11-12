<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel backend\models\article\ArticleCategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <?= $this->render('_search', ['model' => $searchModel])?>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin([
        'timeout'         => 2000,
        'enablePushState' => false,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'       => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'id_category',
            [
                'attribute' => 'id_parent',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->parentCategory->name, ['/article-category/view', 'id' => $model->parentCategory->id_category]);
                }
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>