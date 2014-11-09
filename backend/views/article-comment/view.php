<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model app\models\article\ArticleComment
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Article Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_comment], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_comment], [
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
            'id_comment',
            'id_parent',
            'id_article',
            'id_user',
            'title',
            'text:ntext',
            'status',
            'created',
        ],
    ]) ?>

</div>
