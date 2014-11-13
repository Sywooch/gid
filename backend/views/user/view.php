<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_user], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данного пользователя?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_user',
            'username',
            'email:email',
            'pass',
            [
                'attribute' => 'role',
                'value' => $model->roleText
            ],
            [
                'attribute' => 'status',
                'format'    => 'html',
                'value' => $model->statusSpan
            ],
            'gender',
            'birthday',
            [
                'attribute' => 'created',
                'value'     => Yii::$app->formatter->asDatetime($model->created),
            ],
            [
                'attribute' => 'updated',
                'value'     => Yii::$app->formatter->asDatetime($model->updated),
            ],
            [
                'attribute' => 'last_visit',
                'value'     => Yii::$app->formatter->asDatetime($model->last_visit),
            ],
        ],
    ]) ?>

</div>
