<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\Article
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_article], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_article], [
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
            'id_article',
            'id_category',
            'title',
            'alias',
            'preview:ntext',
            'text:ntext',
            'status',
            'publication',
            'end',
            'views',
            'created',
            'id_created_user',
            'updated',
            'id_updated_user',
        ],
    ]) ?>

</div>
