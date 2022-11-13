<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\bookingcar\models\Category;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
    // 'layout' => 'horizontal',
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <div class="row">
        <div class="col-3">
            <?=$form->field($model, 'start')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ])->label('วันออกเดินทาง');
            ?>
            
        </div>
        <div class="col-3">
        <?=$form->field($model, 'end')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ])->label('วันกลับ');
            ?>
        </div>
        <div class="col-4">
        <?php
echo $form->field($model, 'data_json[car_type]', [
    'inputTemplate' => '<div class="input-group">
    <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa-solid fa-car"></i>&nbsp;</span>
    </div>
    {input}
    </div>',
])->widget(Select2::classname(), [
    'options' => [
        'placeholder' => 'เลือกประเถทรถ ...'
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
    'data' => ArrayHelper::map(Category::find()->where(['type_name' => 'car_type'])->all(), 'id', 'title'),
])->label('ประเภทรถ');
?>
        </div>
        <div class="col-2 mt-4 pt-2">
            <?=Html::submitButton('<i class="fa-solid fa-magnifying-glass"></i> ค้นหา', ['class' => 'btn btn-primary'])?>
        </div>
    </div>
    <?php ActiveForm::end();?>

</div>