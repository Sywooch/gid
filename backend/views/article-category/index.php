<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel app\models\article\ArticleCategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Article Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Category', ['create'], ['class' => 'btn btn-success']) ?>
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
            'id_comment',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>