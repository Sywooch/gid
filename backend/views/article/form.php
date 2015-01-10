<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\article\ArticleCategory;
use dosamigos\datetimepicker\DateTimePicker;
use dosamigos\tinymce\TinyMce;
use mihaildev\elfinder\InputFile;
use backend\assets\AppAsset;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\Article
 * @var $paramUnique common\models\param\ParameterUnique
 * @var $form yii\bootstrap\ActiveForm
 */

$assets = Yii::$app->assetManager->publish('@backend/views/assets/js');
$bundle = AppAsset::register($this);
$bundle->js[] =  Yii::$app->homeUrl . $assets[1] . '/article.js';

$this->registerCss('
    .articleParams .form-group {
        margin-bottom: 1px;
    }
    .articleParamValue input {
        display: inline;
        width: 90% !important;
        margin-right: 5px;
    }
');

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
        'id'     => 'articleForm',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'wrapper' => 'col-sm-10',
            ],
        ],
    ]); ?>

    <div class="form-group col-lg-offset-1 col-lg-11">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'id_category')->dropDownList(
        ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id_category', 'name'),
        ['prompt' => 'Выберите категорию']
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'image')->widget(InputFile::className(), [
        'language'      => 'ru',
        'controller'    => 'elfinder',
        'filter'        => 'image',
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false
    ]) ?>

    <?php $editor = [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]; ?>

    <?= $form->field($model, 'preview')->widget(TinyMce::className(), $editor) ?>

    <?= $form->field($model, 'text')->widget(TinyMce::className(), $editor)?>

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
    ]; ?>

    <?= $form->field($model, 'publication')->widget(DateTimePicker::className(), $dateTimePicker) ?>

    <?= $form->field($model, 'end')->widget(DateTimePicker::className(), $dateTimePicker) ?>

    <section>

        <h3>Дополнительные параметры</h3>

        <div id="searchParams">

            <?= $this->render('_params_search', ['paramUnique' => $paramUnique])?>

        </div>

        <div id="parameters">

            <?php if (!$model->isNewRecord) { ?>

                <?= $this->render('_params', ['params' => $params])?>

            <?php } ?>

        </div>

    </section>

    <?php ActiveForm::end(); ?>

</div>