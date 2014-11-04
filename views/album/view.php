<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model app\models\album\Album
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_album], ['class' => 'btn btn-primary']) ?>
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
        'template' => "<tr><th width='30%'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'id_album',
            'name',
            'released',
            'year',
            'length',
            'template',
            [
                'attribute' => 'type',
                'value'     => $model->typeText,
            ],
            'size',
            [
                'attribute' => 'sound',
                'value'     => $model->soundText,
            ],
            'count_artists',
            [
                'attribute' => 'status',
                'value'     => $model->statusText,
            ],
            [
                'attribute' => 'repeated',
                'value'     => $model->repeatText,
            ],
            [
                'attribute' => 'changed',
                'value'     => $model->changeText,
            ],
            [
                'attribute' => 'device',
                'value'     => $model->deviceText,
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