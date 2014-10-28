<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\artist\Artist */

$this->title = $model->name_artist;
$this->params['breadcrumbs'][] = ['label' => 'Артисты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_artist], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_artist], [
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
            'id_artist',
            'name_artist',
            [
                'attribute' => 'type_artist',
                'value' => $model->typeText,
            ],
            'date_birth',
            'date_death',
            'birthplace',
            'deathplace',
            'resident',
            'years_active',
        ],
    ]) ?>

</div>
