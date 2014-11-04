<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model app\models\song\Song
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Треки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="song-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_song], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_song], [
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
            'id_song',
            'name',
            'year',
            'template',
            [
                'attribute' => 'sound',
                'value'     => $model->soundText,
            ],
            'count_artists',
            [
                'attribute' => 'original',
                'value'     => $model->originalText,
            ],
            [
                'attribute' => 'version',
                'value'     => $model->versionText,
            ],
            [
                'attribute' => 'created',
                'format'    => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'id_created_user',
                'value'     => $model->createdUser->username,
            ],
            [
                'attribute' => 'updated',
                'format'    => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'id_updated_user',
                'value'     => $model->updatedUser->username,
            ],
        ],
    ]) ?>

</div>