<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\article\ArticleCategory;
use dosamigos\datetimepicker\DateTimePicker;
use mihaildev\ckeditor\CKEditor;

use common\models\article\ArticleParam;

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
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'wrapper' => 'col-sm-10',
            ],
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'id_category')->dropDownList(
        ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id_category', 'name'),
        ['prompt' => 'Выберите категорию']
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'preview')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'standard',
        ],
    ]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
        ],
    ]) ?>

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

    <?php foreach ($model->params as $params ) { ?>

        <?= $form->field($params, 'value')->textInput(['maxlength' => 255])->label('sd')  ?>

    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>