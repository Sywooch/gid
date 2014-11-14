<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $searchModel backend\models\article\ArticleCommentSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-comment-index">

    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <?php Pjax::begin([
        'timeout'         => 2000,
        'enablePushState' => false,
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'       => "{items}\n{summary}\n{pager}",
        'columns' => [
            'id_comment',
            'id_parent',
            [
                'attribute' => 'id_article',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->article->title, ['/article/view', 'id' => $model->id_article]);
                }
            ],
            [
                'attribute' => 'id_user',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->user->username, ['/user/view', 'id' => $model->id_user]);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    return "<span class='label " . $model->statusClass . "'>" . $model->statusText . '</span>';
                }
            ],
            [
                'attribute' => 'created',
                'value'     => function($model) {
                    return Yii::$app->formatter->asDatetime($model->created);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>