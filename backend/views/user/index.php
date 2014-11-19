<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel backend\models\UserSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p><?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= $this->render('_search', ['model' => $searchModel])?>

    <?php Pjax::begin([
        'timeout'         => 5000,//TODO
        'enablePushState' => false,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function($model) {
                    return $model->roleName;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    return $model->statusText;
                }
            ],
            'id_user',
            // 'gender',
            // 'birthday',
            // 'created',
            // 'updated',
            // 'last_visit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>