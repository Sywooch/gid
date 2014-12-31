<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Параметры (уник)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-unique-index">

    <p><?= Html::a('Добавить параметр', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?php Pjax::begin([
        'timeout'         => 5000,
        'enablePushState' => false,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'       => "{items}\n{summary}\n{pager}",
        'columns' => [

            'name',
            'id_param',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>