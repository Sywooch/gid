<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\ArticleComment
 * @var $form yii\bootstrap\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->title = 'Обновить комментарий №' . $model->id_comment;
$this->params['breadcrumbs'][] = ['label' => 'Комментарий №' . $model->id_comment, 'url' => ['view', 'id' => $model->id_comment]];
$this->params['breadcrumbs'][] = 'Обновить';

?>

<div class="article-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray) ?>

    <?php ActiveForm::end(); ?>

</div>