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

    <div id="comments-list">

        <p>Комментарии (<?= $article->commentsCount?>)</p>

        <?php $form = ActiveForm::begin([
            'id'     => 'newCommentForm',
            //'action' => ['article/add-comment'],
        ]); ?>

        <?= $form->field($newComment, 'id_article', ['template' => "{input}"])->hiddenInput(['value' => $article->id_article]) ?>

        <?= $form->field($newComment, 'id_parent', ['template' => "{input}"])->hiddenInput(['value' => null]) ?>

        <?= $form->field($newComment, 'text')->textarea(['rows' => 3, 'placeholder' => 'Введите текст сообщения'])->label('Добавить комментарий') ?>

        <div class="form-group">
            <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary btn-xs']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php
            $this->render('_comment');

            foreach ($comments as $comment) {
                commentTree($comment);
            }
        ?>
    </div>

</div>