<?php

use yii\helpers\Html;
/*
 * @var $this yii\web\View
 */
?>

<h1><?=$model->name ?></h1>

<div class="body-content">

    <div class="row">

        <?php foreach($articles as $article) { ?>

            <div class="col-sm-4 col-xs-6 thumbnail">

                <?= Html::img($article->image, ['alt' => $article->title]) ?>

                <?php
                $public = \Yii::$app->formatter->asDate($article->publication, 'long');
                echo Html::tag('time', $public, ['datetime' => $public]);
                ?>

                <h2><?= Html::a($article->title, ['/article/view', 'alias' => $article->alias]) ?></h2>

                <p><?= $article->preview ?></p>

            </div>

        <?php } ?>

    </div>

</div>