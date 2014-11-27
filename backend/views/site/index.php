<?php
/**
 * @var $this yii\web\View
 * @var $users yii\data\ActiveDataProvider
 * @var $comments yii\data\ActiveDataProvider
 */
use yii\grid\GridView;
use backend\widgets\SmallBoxWidget;

$this->title = 'Контрольная панель';
?>

<div class="site-index">

    <div class="row">
        <?= SmallBoxWidget::widget([
            'color'     => 'bg-aqua',
            'header'    => $articlesCount,
            'paragraph' => 'статей',
            'icon'      => 'glyphicon glyphicon-book',
            'link'      => '/article/index',
        ])?>

        <?= SmallBoxWidget::widget([
            'color'     => 'bg-green',
            'header'    => $commentsCount,
            'paragraph' => 'комментариев',
            'icon'      => 'glyphicon glyphicon-comment',
            'link'      => '/article-comment/index',
        ])?>

        <?= SmallBoxWidget::widget([
            'color'     => 'bg-yellow',
            'header'    => $usersCount,
            'paragraph' => 'пользователя',
            'icon'      => 'glyphicon glyphicon-user',
            'link'      => '/user/index',
        ])?>

        <?= SmallBoxWidget::widget([
            'header'    => '???',
            'paragraph' => '???',
        ])?>
    </div>


    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Последние 5 зарегистрированных пользователей</h3>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $users,
                    'layout'       => "{items}",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        [
                            'attribute' => 'created',
                            'value' => function($model) {
                                return Yii::$app->formatter->asDatetime($model->created);
                            }
                        ]
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Последние 5 комментариев</h3>
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $comments,
                    'layout'       => "{items}",
                    'columns' => [
                        'id_comment',
                        [
                            'attribute' => 'id_article',
                            'value' => function($model) {
                                return $model->article->title;
                            }
                        ],
                        [
                            'attribute' => 'created',
                            'value' => function($model) {
                                return Yii::$app->formatter->asDatetime($model->created);
                            }
                        ]
                    ],
                ]) ?>
            </div>
        </div>
    </div>

</div>