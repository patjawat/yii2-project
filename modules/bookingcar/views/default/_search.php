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
    'action' => ['/bookingcar/booking/create'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <div class="row">
        <div class="col-4">
            <?=$form->field($model, 'date_start')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ])->label('วันออกเดินทาง');
            ?>
        </div>
        <div class="col-4">
        <?=$form->field($model, 'date_end')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ])->label('วันกลับ');
            ?>
        </div>
        <div class="col-4">
            <?php // Html::a('จองรถ',['/bookingcar/booking/create','date_start' => $model->date_start,'date_end' => $model->date_end])?>
            <?=Html::submitButton('จองรถ', ['class' => 'btn btn-primary','style' => 'margin-top:31px'])?>
        </div>
    </div>
    <?php ActiveForm::end();?>

</div>