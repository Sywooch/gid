<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

/**
 * @var $this yii\web\View
 * @var $article common\models\article\Article
 * @var $comments common\models\article\ArticleComment
 * @var $newComment common\models\article\ArticleComment
 * @var $form yii\bootstrap\ActiveForm
 */

$this->registerCss("
    /*font-size: 18px;*/
    .media-left, .media-right, .media-body {
        display: table-cell;
        vertical-align: top;
    }
    .media-left, .media>.pull-left {
        padding-right: 10px;
    }
");



$assets = Yii::$app->assetManager->publish('@frontend/views/assets/js');
$bundle = AppAsset::register($this);
$bundle->js[] =  Yii::$app->homeUrl . $assets[1] . '/comment.js';



$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::$app->formatter->asNtext($article->text)?>

    <?php $form = ActiveForm::begin([
        'id'     => 'newCommentForm',
        //'action' => ['article/add-comment'],
    ]); ?>

    <?= $form->field($newComment, 'id_article', ['template' => "{input}"])->hiddenInput(['value' => $article->id_article]) ?>

    <?= $form->field($newComment, 'id_parent', ['template' => "{input}"])->hiddenInput(['value' => null]) ?>

    <?= $form->field($newComment, 'text')->textarea(['rows' => 3, 'placeholder' => 'Введите текст сообщения'])->label('Добавить комментарий') ?>

    <div class="form-group">
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <p>Комментарии (<?= $article->commentsCount?>)</p>

    <?php function commentTree($comment) { ?>

        <ul class="media-list" id="comment-<?=$comment->id_comment?>">
            <li class="media">
                <a class="media-left" href="#">
                    <img src="/images/cover.jpg" alt="..." width='64' height='64' class="img-circle">
                </a>
                <div class="media-body">
                    <p class="media-heading">
                        <?=
                            Html::a($comment->user->username, ['user/view', 'name' => $comment->user->username]) . ' ' .
                            Yii::$app->formatter->asDatetime($comment->created) . ' ' .
                            Html::a('#', '#comment-' . $comment->id_comment)
                        ?>
                    </p>
                    <p style="min-height: 35px;"><?= Yii::$app->formatter->asNtext($comment->text) ?></p>
                    <?php
                        foreach ($comment->childComments as $child)
                            commentTree($child);
                    ?>
                </div>
            </li>
        </ul>

    <? } ?>

    <?php
        foreach ($comments as $comment) {
            commentTree($comment);
        }
    ?>

</div>