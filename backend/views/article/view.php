<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\Article
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_article], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_article], [
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
            [
                'attribute' => 'id_category',
                'format' => 'html',
                'value' => Html::a($model->category->name, ['article-category/view', 'id' => $model->id_category]),
            ],
            'title',
            'alias',
            'preview:ntext',
            'text:ntext',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->statusText
            ],
            [
                'attribute' => 'publication',
                'value'     => Yii::$app->formatter->asDatetime($model->publication),//TODO
            ],
            [
                'attribute' => 'end',
                'value'     => Yii::$app->formatter->asDatetime($model->end),
            ],
            'views',
            [
                'attribute' => 'created',
                'value'     => Yii::$app->formatter->asDatetime($model->created),
            ],
            [
                'attribute' => 'id_created_user',
                'value'     => $model->createdUser->username,
            ],
            [
                'attribute' => 'updated',
                'value'     => Yii::$app->formatter->asDatetime($model->updated),
            ],
            [
                'attribute' => 'id_updated_user',
                'value'     => $model->updatedUser->username,
            ],
        ],
    ]) ?>

</div>
