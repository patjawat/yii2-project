<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\widgets\DateTimePicker;
use yii\web\View;
use kriss\calendarSchedule\widgets\FullCalendarWidget;
use kriss\calendarSchedule\widgets\processors\EventProcessor;
use kriss\calendarSchedule\widgets\processors\HeaderToolbarProcessor;
use kriss\calendarSchedule\widgets\processors\LocaleProcessor;



?>

<div class="booking-form container card p-3" style="width:90%">

    <div class="card-body">


        <?php $form = ActiveForm::begin([
        // 'layout' => 'horizontal',
        // 'fieldConfig' => [
        //     'horizontalCssClasses' => [
        //         'label' => 'col-lg-2 col-md-2 col-sm-3',
        //         'wrapper' => 'col-lg-8 col-md-8 col-sm-8 offset-sm-0',
        //     ],
        // ],
    ]); ?>

        <div class="alert alert-primary" role="alert">แผนการเดินทางเลือกยานพาหนะ</div>
        
        
        <?= $form->field($model, 'data_json[destination]')->textInput()->label('สถานที่ไป') ?>
        <div class="row">
            <div class="col-6">
                <?=$form->field($model, 'date_start')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
                    'language' => 'th',
                    'pluginOptions' => [
                        'autoclose' => true
                        ]
                        ])->label('วันที่เริ่มต้น/เวลาเริ่มต้น');
                        ?>
                        <?=$form->field($model, 'date_end')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
                            'language' => 'th',
                            'pluginOptions' => [
                                'autoclose' => true
                                ]
                                ])->label('วันที่สิ้นสุด/เวลาสิ้นสุด');
                                ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'data_json[point]')->textInput()->label('สถานที่รับ') ?>
                
            </div>
        </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('รายละเอียดการขอใช้') ?>

        <?= $form->field($model, 'passengers_number', [
        'inputTemplate' => '<div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-users"></i></span>
        {input}
        <span class="input-group-text">ท่าน</span>
      </div>',
    ])->textInput(['type' => 'number']) ?>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'data_json[booker]',[
        'inputTemplate' => '<div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
        {input}
      </div>',
    ])->textInput(['maxlength' => true])->label('ชื่อผู้จอง') ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'data_json[booker_phone]',[
        'inputTemplate' => '<div class="input-group mb-3">
        <span class="input-group-text"><i class="fa-solid fa-square-phone"></i></span>
        {input}
      </div>',
    ])->textInput(['maxlength' => true])->label('เบอร์โทรติดต่อ') ?>
            </div>
        </div>

        <div class="alert alert-primary" role="alert"><i class="fa-solid fa-map-location-dot"></i> จุดหมายปลายทาง</div>

        <?= $form->field($model, 'province_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'district_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'passengers_name')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'data_json[note]')->textInput()->label('อื่นๆ') ?>
        <?= $form->field($model, 'contact_name')->textInput() ?>

        <?= $form->field($model, 'contact_phone')->textInput() ?>

        <?= $form->field($model, 'rally_point')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>


        <?= $form->field($model, 'stopover')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'cost_type')->textInput() ?>

        <?= $form->field($model, 'person_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'certifier_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'certifier_position')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'author_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'author_position')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date_end')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'time_end')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'receive')->textInput() ?>

        <?= $form->field($model, 'driver')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'car_id')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    This is some text wi
    thin a card body.
</div>

<?php
$js = <<< JS

JS;
$this->registerJs($js,View::POS_END);
?>