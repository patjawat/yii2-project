<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\DateTimePicker;
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
        <div class="col-4">
            <?=$form->field($model, 'start')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ])->label('วันออกเดินทาง');
            ?>
            
        </div>
        <div class="col-4">
        <?=$form->field($model, 'end')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ])->label('วันกลับ');
            ?>
        </div>
        <div class="col-4 mt-4 pt-2">
            <?=Html::submitButton('<i class="fa-solid fa-magnifying-glass"></i> ค้นหา', ['class' => 'btn btn-primary'])?>
        </div>
    </div>
    <?php ActiveForm::end();?>

</div>