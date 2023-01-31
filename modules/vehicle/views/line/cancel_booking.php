<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    label {
    display: inline-block;
    font-family: 'Prompt';
    font-weight: 400;
}
</style>
<div class="row justify-content-md-center mt-5">

    <div class="col-12">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->hiddenInput(['value' => 'cancel'])->label(false) ?>

    <?= $form->field($model, 'data_json[cancel_note]')->textArea(['required'=>true,'rows' => '6'])->label('ระบุเหตุผลที่ต้องการยกเลิก'); ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('ตกลง', ['class' => 'btn btn-primary']) ?>
        <?=Html::a('ยกเลิก',['/vehicle/booking'], ['class' =>'btn btn-danger']);?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
