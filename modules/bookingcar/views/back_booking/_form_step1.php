<?php
use kartik\touchspin\TouchSpin;
use kartik\widgets\DateTimePicker;
?>
<div class="row">
    <div class="col-6">
        <?=$form->field($model, 'date_start')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('ออกเดินทาง');
?>
    </div>
    <div class="col-6">
        <?=$form->field($model, 'date_end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('วันกลับ');
?>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <?=$form->field($model, 'cars[van]')->widget(TouchSpin::classname(), [
    'options' => ['placeholder' => 'จำนวน ...'],
    'pluginOptions' => [
        'buttonup_class' => 'btn btn-primary',
        'buttondown_class' => 'btn btn-info',
        'buttonup_txt' => '<i class="fas fa-plus-circle"></i>',
        'buttondown_txt' => '<i class="fas fa-minus-circle"></i>',
    ],
]);?>
        <?=$form->field($model, 'cars[bus]')->widget(TouchSpin::classname(), [
    'options' => ['placeholder' => 'จำนวน ...'],
    'pluginOptions' => [
        'buttonup_class' => 'btn btn-primary',
        'buttondown_class' => 'btn btn-info',
        'buttonup_txt' => '<i class="fas fa-plus-circle"></i>',
        'buttondown_txt' => '<i class="fas fa-minus-circle"></i>',
    ],
]);?>

    </div>
    <div class="col-4">
        <?=$form->field($model, 'cars[truck]')->widget(TouchSpin::classname(), [
    'options' => ['placeholder' => 'จำนวน ...'],
    'pluginOptions' => [
        'buttonup_class' => 'btn btn-primary',
        'buttondown_class' => 'btn btn-info',
        'buttonup_txt' => '<i class="fas fa-plus-circle"></i>',
        'buttondown_txt' => '<i class="fas fa-minus-circle"></i>',
    ],
]);?>
        <?=$form->field($model, 'cars[small_truck]')->widget(TouchSpin::classname(), [
    'options' => ['placeholder' => 'จำนวน ...'],
    'pluginOptions' => [
        'buttonup_class' => 'btn btn-primary',
        'buttondown_class' => 'btn btn-info',
        'buttonup_txt' => '<i class="fas fa-plus-circle"></i>',
        'buttondown_txt' => '<i class="fas fa-minus-circle"></i>',
    ],
]);?>
    </div>
    <div class="col-4">
        <?=$form->field($model, 'cars[sedan]')->widget(TouchSpin::classname(), [
    'options' => ['placeholder' => 'จำนวน ...'],
    'pluginOptions' => [
        'buttonup_class' => 'btn btn-primary',
        'buttondown_class' => 'btn btn-info',
        'buttonup_txt' => '<i class="fas fa-plus-circle"></i>',
        'buttondown_txt' => '<i class="fas fa-minus-circle"></i>',
    ],
]);?>

    </div>
</div>