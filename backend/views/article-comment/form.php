<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\ArticleComment
 * @var $form yii\widgets\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Article Comments', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Create Article Comment';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Article Comment: ' . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_comment]];
    $this->params['breadcrumbs'][] = 'Update';
}

?>

<div class="article-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_parent')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'id_article')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
