<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .form-control-lg {
    font-weight: 800;
    width: 130%;

}
</style>
<div class="col d-flex align-items-center justify-content-center" style="position: absolute;top:20%;left:30px;">

    <?php $form = ActiveForm::begin([
        'action' => ['signup'],
        'id' => 'form-search',
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'phone')->textInput(['class' => 'form-control-lg','placeholder' => 'ระบุหมายเลขโทรศัพท์'])->label(false) ?>
    <?= $form->field($model, 'email')->textInput(['class' => 'form-control-lg mt-1','placeholder' => 'ระบุบัญชีอีเมล'])->label(false) ?>
    <?= $form->field($model, 'position_name')->textInput(['class' => 'form-control-lg mt-1','placeholder' => 'ระบุตำแหน่ง'])->label(false) ?>
    <?= $form->field($model, 'line_id')->hiddenInput(['id' => 'line_id'])->label(false); ?>

    <div class="d-grid gap-2 col-12 mx-auto">
        <?= Html::submitButton('ตกลง', ['class' => 'btn btn-lg btn-primary mt-3','style' => ' width: 130%;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
