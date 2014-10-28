<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\artist\ArtistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Артисты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <p>
        <?= Html::a('Добавить Артиста/Группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_artist',

            [
                'attribute' => 'type_artist',
                'value' => function($model) {
                    return $model->typeText;
                }
            ],

            'id_artist',
            // 'birthplace',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

</div>
