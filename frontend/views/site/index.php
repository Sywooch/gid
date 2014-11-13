<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $articles common\models\article\Article
 */
$this->title = 'Музыкальный Гид';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">

            <?php foreach($articles as $article) { ?>

            <div class="col-sm-4 col-xs-6">

                <h2><?= Html::a($article->title, ['/article/view', 'alias' => $article->alias]) ?></h2>

                <?= Html::tag('time', \Yii::$app->formatter->asDate($article->publication), ['datetime' => \Yii::$app->formatter->asDatetime($article->publication)]) ?>

                <p><?= $article->preview ?></p>

            </div>

            <?php } ?>

        </div>

    </div>
</div>