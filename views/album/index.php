<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
* @var $this yii\web\View
* @var $searchModel app\models\album\AlbumSearch
* @var $dataProvider yii\data\ActiveDataProvider
*/

$this->title = 'Альбомы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Добавить альбом', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <?php Pjax::begin([
        'timeout'         => 2000,
        'enablePushState' => false,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'year',
            [
                'attribute' => 'type',
                'value'     => function($model) {
                    return $model->typeText;
                }
            ],
            [
                'attribute' => 'sound',
                'value'     => function($model) {
                    return $model->soundText;
                }
            ],
            'id_album',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>