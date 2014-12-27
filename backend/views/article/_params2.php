<?php
use yii\helpers\Html;

$index = $model->id_param;
?>
<div class="articleParams">

    <?= Html::activeHiddenInput($model, "[$index]id_param", ['class' => 'paramInput']) ?>

    <div class="form-group field-articleparam-<?= $index ?>-value required">
        <?= Html::label($model->parameterUnique->name, "articleparam-$index-value", ['class' => 'control-label col-sm-2']) ?>
        <div class="col-sm-8">
            <div class="articleParamValue">
                <?= Html::activeTextInput($model, "[$index]value", ['class' => 'form-control', 'value' => $model->value, 'maxlength' => "255"]) ?>
                <a href="#" class="delParam"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <div class="help-block help-block-error"></div>
        </div>
    </div>
</div>
<?php
$this->registerJs("
    $('#articleForm').yiiActiveForm('add', {
        'id'        : 'articleparam-" . $index . "-value',
        'name'      : '[" . $index . "]value',
        'container' : '.field-articleparam-" . $index . "-value',
        'input'     : '#articleparam-" . $index . "-value',
        'error'     : '.help-block.help-block-error',
        'validate'  : function (attribute, value, messages, deferred) {
            yii.validation.required(value, messages, {
                'message' : 'Необходимо заполнить «Значение параметра».'
            });
            yii.validation.string(value, messages, {
                'message'     : 'Значение «Значение параметра» должно быть строкой.',
                'max'         : 255,
                'tooLong'     : 'Значение «Значение параметра» должно содержать максимум 255 символа.',
                'skipOnEmpty' : 1
            });
        }
    });
", $this::POS_LOAD);