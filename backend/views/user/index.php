<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?= $this->render('_search', ['model' => $searchModel])?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_user',
            'username',
            'email:email',
            'pass',
            'role',
            // 'status',
            // 'gender',
            // 'birthday',
            // 'created',
            // 'updated',
            // 'last_visit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
