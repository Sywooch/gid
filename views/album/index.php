<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\album\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Альбомы';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <p>
        <?= Html::a('Добавить альбом', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_album',
            [
                'label' => 'Артисты',
                'format' => 'raw',
                'value' => function($model) {
                    $arr = '';
                    foreach ($model->artist as $artist) {
                        $arr .= $artist->name_artist . ' ';
                    }
                    return $arr;
                },
            ],
            'year_album',
            'id_album',
            // 'length_album',
            // 'template',
            // 'size_disk',
            // 'disks',
            // 'number_album',
            // 'sound',
            // 'artists',
            // 'count_artists',
            // 'status_album',
            // 'repeated',
            // 'changed',
            // 'times:datetime',
            // 'dead',
            // 'ost',
            // 'device',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

</div>