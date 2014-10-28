<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\album\Album */

$this->title = $model->name_album;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_album], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_album], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_album',
            'name_album',
            'alt_name_album',
            'released',
            'recorded',
            'year_album',
            'length_album',
            'template',
            'size_disk',
            'disks',
            'number_album',
            'sound',
            'artists',
            'count_artists',
            'status_album',
            'repeated',
            'changed',
            'times:datetime',
            'dead',
            'ost',
            'device',
            'meta_description',
        ],
    ]) ?>

</div>
