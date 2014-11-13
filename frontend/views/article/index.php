<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_article',
            'id_category',
            'title',
            'alias',
            'preview:ntext',
            // 'text:ntext',
            // 'status',
            // 'active',
            // 'publication',
            // 'end',
            // 'views',
            // 'created',
            // 'id_created_user',
            // 'updated',
            // 'id_updated_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>