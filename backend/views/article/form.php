<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\article\ArticleCategory;
use dosamigos\datetimepicker\DateTimePicker;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\Article
 * @var $form yii\bootstrap\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить статью';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Обновить статью: ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_article]];
    $this->params['breadcrumbs'][] = 'Обновить';
}

$model->end = ($model->end) ? Yii::$app->formatter->asDateTime($model->end, 'php:d.m.Y H:i:s') : '';
$model->publication = ($model->publication) ? Yii::$app->formatter->asDateTime($model->publication, 'php:d.m.Y H:i:s') : '';
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id_category')->dropDownList(
        ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id_category', 'name'),
        ['prompt' => 'Выберите категорию']
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray) ?>

    <?php $dateTimePicker = [
        'language' => 'ru',
        'size' => 'xs',
        'template' => "{button}{reset}{input}",
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy HH:ii:ss',
            'todayBtn' => true,
            'pickerPosition' => "top-right"
        ]
    ];?>

    <?= $form->field($model, 'publication')->widget(DateTimePicker::className(), $dateTimePicker) ?>

    <?= $form->field($model, 'end')->widget(DateTimePicker::className(), $dateTimePicker) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>