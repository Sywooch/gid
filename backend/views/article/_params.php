<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 28.11.2014
 * Time: 18:21
 */

use yii\helpers\Html;
?>

<?php foreach ($params as $index => $param) { ?>

    <div class="articleParams">

        <?= Html::activeHiddenInput($param, "[$index]id_article", ['class' => 'articleInput']) ?>

        <?= Html::activeHiddenInput($param, "[$index]id_param", ['class' => 'paramInput']) ?>

        <div class="form-group field-articleparam-<?= $index ?>-value required">
            <?= Html::label($param->parameterUnique->name, "articleparam-$index-value", ['class' => 'control-label col-sm-2']) ?>
            <div class="col-sm-8">
                <div class="articleParamValue">
                    <?= Html::activeTextInput($param, "[$index]value", ['class' => 'form-control', 'value' => $param->value, 'maxlength' => "255"]) ?>
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
} ?>