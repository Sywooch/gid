<?php

use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

/**
 * @var $this yii\web\View
 */

$this->title = 'Файловый менеджер';
?>

<div class="row">
    <div class="col-xs-12">
        <?= ElFinder::widget([
            'language'         => 'ru',
            'frameOptions'     => ['style' => 'min-height: 500px; width: 100%'],
            'controller'       => 'elfinder',
            'filter'           => 'image',
            'callbackFunction' => new JsExpression('function(file, id){}') // id - id виджета
        ]) ?>
    </div>
</div>