<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\param\ParameterUnique
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Параметры (уник)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameter-unique-view">
    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_param], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_param], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данный параметр?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_param',
            'name',
        ],
    ]) ?>

</div>