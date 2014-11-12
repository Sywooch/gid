<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\ArticleComment
 */

$this->title = 'Комментарий №' . $model->id_comment;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-comment-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id_comment], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_comment], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данный комментарий?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_comment',
            [
                'attribute' => 'id_parent',
                'format' => 'html',
                'value' => ($model->id_parent) ?
                    Html::a('Комменарий №' . $model->id_parent, ['/article-comment/view', 'id' => $model->id_parent]) :
                    '',
            ],
            [
                'attribute' => 'id_article',
                'format' => 'html',
                'value' => Html::a($model->article->title, ['/article/view', 'id' => $model->id_article]),
            ],
            [
                'attribute' => 'id_user',
                'format' => 'html',
                'value' => Html::a($model->user->username, ['/user/view', 'id' => $model->id_user]),
            ],
            'title',
            'text:ntext',
            [
                'attribute' => 'status',
                'value' => $model->statusText,
            ],
            [
                'attribute' => 'created',
                'value'     => Yii::$app->formatter->asDatetime($model->created),
            ],
        ],
    ]) ?>

</div>