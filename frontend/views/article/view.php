<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\Article
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_article',
            'id_category',
            'title',
            'alias',
            'preview:ntext',
            'text:ntext',
            'status',
            'active',
            'publication',
            'end',
            'views',
            'created',
            'id_created_user',
            'updated',
            'id_updated_user',
        ],
    ]) ?>

</div>