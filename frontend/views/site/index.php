<?php

use yii\helpers\Html;
use yii\bootstrap\Carousel;


/**
 * @var $this yii\web\View
 * @var $articles common\models\article\Article
 * @var $popularArticles common\models\article\Article
 */
$this->title = 'Музыкальный Гид';

$this->registerLinkTag([
    'title' => 'Музыкальный гид: блог',
    'rel'   => 'alternate',
    'type'  => 'application/rss+xml',
    'href'  => '/rss.xml',
]);

$this->registerCss('
    .carousel {
        background-color: #AD99CC;
        margin-bottom: 5px;
    }
    .carousel a{
        color: #fff;
    }
    .item img{
        margin:auto;
        max-height: 400px;
    }
');
?>
<div class="site-index">

    <?php
        foreach($popularArticles as $article) {
            $items[] = [
                'content' => '<img src="' . $article->image . '">',
                'caption' => '<h4>' . Html::a($article->title, ['/article/view', 'alias' =>$article->alias], ['target' => '_blank']) . '</h4>',
            ];
        }
    ?>

    <?= Carousel::widget([
        'items' => $items,
    ])?>

    <div class="body-content">

        <div class="row">

            <?php foreach($articles as $article) { ?>

            <div class="col-sm-4 col-xs-6 thumbnail">

                <?= Html::img($article->image, ['alt' => $article->title]) ?>

                <?php
                    $public = \Yii::$app->formatter->asDate($article->publication, 'long');
                    echo Html::a($article->category->name, ['category/view', 'id' => $article->category->id_category]) . ' ' .
                        Html::tag('time', $public, ['datetime' => $public]);
                ?>

                <h2><?= Html::a($article->title, ['/article/view', 'alias' => $article->alias]) ?></h2>

                <p><?= $article->preview ?></p>

            </div>

            <?php } ?>

        </div>

    </div>
</div>