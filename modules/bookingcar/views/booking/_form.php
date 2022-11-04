<?php

use app\models\Provinces;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use kartik\widgets\DateTimePicker;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */
/** @var yii\widgets\ActiveForm $form */

?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 300px;
}
</style>

<div class="row">
    <div class="col-8">
        <?php $form = ActiveForm::begin();?>

        <?=$form->field($model, 'ref')->hiddenInput(['maxlength' => true])->label(false)?>

        <?=$form->field($model, 'data_json[title]', [
                'inputTemplate' => '<div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-regular fa-pen-to-square"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
                ])->textInput()->label('วัตถุประสงค์การจอง')?>


        <?=$form->field($model, 'date_start')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่ออกเดินทาง ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('วันเวลาที่ออกเดินทาง');
?>

        <div class="alert alert-primary" role="alert">จุดหมายปลายทาง</div>
        <div class="row">
    <div class="col-4">
        <?=$form->field($model, 'data_json[passenger_number]', [
                'inputTemplate' => '<div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-users"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
                ])->textInput(['type' => 'number'])->label('จำนวนผู้โดยสาร')?>
    </div>
    <div class="col-8">
        <?=$form->field($model, 'car_id', [
                'inputTemplate' => '<div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-car"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
                ])->widget(Select2::classname(), [
                    'options' => ['placeholder' => 'เลือกจังหวัด ...'],
                    'data' => ArrayHelper::map(Provinces::find()->all(), 'id', 'name_th'),
                ]);?>

    </div>
        </div>

        <div class="row">
            <div class="col-4">
                <?=$form->field($model, 'data_json[point]', [
                'inputTemplate' => '<div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i>&nbsp;</span>
                </div>
                {input}
                </div>',
                ])->textInput()->label('จุดหมายปลายทาง')?>
            </div>
            <div class="col-4">
                <?php
echo $form->field($model, 'province_id')->widget(Select2::classname(), [
    'options' => ['placeholder' => 'เลือกจังหวัด ...'],
    'data' => ArrayHelper::map(Provinces::find()->all(), 'id', 'name_th'),
]);
?>
            </div>
            <div class="col-4">
                <?=$form->field($model, 'district_id')->widget(DepDrop::className(), [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'subcat1-id', 'placeholder' => 'เลือก ...'],
                                'pluginOptions' => [
                                    'depends' => [Html::getInputId($model, 'province_id')],
                                    'placeholder' => 'เลือกอำเภอ',
                                    'url' => Url::to(['district-list']),
                                ],
                            ])?>
            </div>
        </div>


        <?=$form->field($model, 'date_end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'เลือกวันเวลาที่วันกลับ ...'],
    'language' => 'th',
    'pluginOptions' => [
        'autoclose' => true,
    ],
])->label('วันเวลาที่วันกลับ');
?>



        <div class="form-group">
            <?=Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success'])?>
        </div>

        <?php ActiveForm::end();?>
    </div>
    <div class="col-4">
        <br>
        <div class="box-img" data-aos="fade-left">
            <?=Html::img(['/file', 'id' => 15])?>
        </div>
        <table class="table table-light">
            <tbody>
                <tr>
                    <td>เลขทะเบียน</td>
                    <td>xx</td>
                </tr>
                <tr>
                    <td>ยี่ห้อ</td>
                    <td>xx</td>
                </tr>
                <tr>
                    <td>รุ่น</td>
                    <td>xx</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>