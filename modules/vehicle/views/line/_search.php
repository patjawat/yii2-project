<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\vehicle\models\Category;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
    // 'layout' => 'horizontal',
    'id' => 'form-search',
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'start')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวัน ...'],
                // 'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                ]
            ])->label('วันออกเดินทาง');
            ?>
            
        </div>
        <div class="col-12">
        <?=$form->field($model, 'end')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวัน ...'],
                // 'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ])->label('วันกลับ');
            ?>
        </div>
        <div class="col-12">
        <?php
echo $form->field($model, 'data_json[car_type]')->widget(Select2::classname(), [
    'options' => [
        'placeholder' => 'เลือกประเถทรถ ...'
    ],
    'size' => Select2::LARGE,
    'pluginOptions' => [
        'allowClear' => true
    ],
    'data' => ArrayHelper::map(Category::find()->where(['type_name' => 'car_type'])->all(), 'id', 'title'),
])->label('ประเภทรถ');
?>
        </div>
        <div class="col-12">
        <div class="d-grid gap-2">
            <?=Html::submitButton('<i class="fa-solid fa-magnifying-glass"></i> ค้นหา', ['class' => 'btn btn-lg btn-primary'])?>
        </div>
        </div>
    </div>
    <?php ActiveForm::end();?>

</div>