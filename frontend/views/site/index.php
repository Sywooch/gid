<?php

use yii\helpers\Html;
use yii\bootstrap\Carousel;


/**
 * @var $this yii\web\View
 * @var $articles common\models\article\Article
 */
$this->title = 'Музыкальный Гид';
?>
<div class="site-index">

    <div class="jumbotron">
        <?= Carousel::widget([
            'items' => [
                [
                    'content' => '<img src="http://www.kinokadr.ru/filmzimg/i/interstellar/gallery/01.jpg"/>',
                    'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                    //'options' => [...],
                ],
                [
                    'content' => '<img src="http://www.kinokadr.ru/filmzimg/i/interstellar/gallery/02.jpg"/>',
                    'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                    //'options' => [...],
                ],
            ]
        ]);?>
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