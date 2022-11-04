<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<style>
    .box-img{
        position: relative;
        /* width:500px; */
    }
    .box-img > img{
        width:500px;
    }
</style>
<div class="category-form">
<div class="row">
    <div class="col-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'group_name')->hiddenInput(['value' => 'car'])->label(false) ?>

    <?= $form->field($model, 'type_name')->hiddenInput(['value' => 'car'])->label(false) ?>
    <?= $form->field($model, 'data_json[band]')->textInput(['rows' => 6])->label('ยี่ห้อ') ?>
    <?= $form->field($model, 'data_json[model]')->textInput(['rows' => 6])->label('รุ่น') ?>
    <?= $form->field($model, 'data_json[car_regis]')->textInput(['rows' => 6])->label('ทะเบียนรถ') ?>

<div style="margin-top:10px">
    <?= $form->field($model,'file')->fileInput(); ?>
</div>

    <div class="form-group mt-3">
        <?= Html::submitButton('<i class="fa-solid fa-check"></i> บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    </div>
    <div class="col-6">
        <div class="box-img" data-aos="fade-left">
            <?= Html::img(['/file','id'=>$model->id]) ?>
        </div>
    </div>
</div>


    <?php ActiveForm::end(); ?>

</div>
