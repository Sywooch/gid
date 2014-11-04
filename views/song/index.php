<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel app\models\song\SongSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Треки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="song-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Добавить трек', ['create'], ['class' => 'btn btn-success']) ?></p>

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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>