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
    ul {
        padding-left: 0;
        list-style: none;
    }
    .avatar {
        margin-right: 10px;
    }
    .reply {
        font-size: 12px;
        color: #999CA5;
        text-decoration: underline;
        cursor: pointer;
    }
    #comments {
        position: relative;
        padding: 15px;
        margin: 0 -15px 15px;
        border-color: #e5e5e5 #eee #eee;
        border-style: solid;
        border-width: 1px;
        border-radius: 4px 4px 0 0;
        box-shadow: inset 0 3px 6px rgba(0, 0, 0, .05);
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


    <section id="comments">

        <h3>Комментарии (<?= $article->commentsCount?>)</h3>

        <?php $form = ActiveForm::begin([
            'id' => 'newCommentForm',
        ]); ?>

        <?= $form->field($newComment, 'id_article', ['template' => "{input}"])->hiddenInput(['value' => $article->id_article]) ?>

        <?= $form->field($newComment, 'id_parent', ['template' => "{input}"])->hiddenInput(['value' => null]) ?>

        <?= $form->field($newComment, 'text')->textarea(['rows' => 3, 'placeholder' => 'Введите текст сообщения'])->label('Добавить комментарий') ?>

        <div class="form-group">
            <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary btn-xs']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div id="comments-list">

            <?php
                $this->render('_comment');

                foreach ($comments as $comment) {
                    commentTree($comment);
                }
            ?>

        <div id="comments-list">

    </section>

</div>