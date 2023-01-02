<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
        // 'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php echo   $form->field($model, 'phone')->textInput() ?>
    <?php // echo   $form->field($model, 'id')->textInput(['value' => '0909748044']) ?>
    <?php // $form->field($model, 'phone')->textInput() ?>
    <?php // $form->field($model, 'line_id')->textInput(['maxlength' => true,'id' => 'line_id'])->label(false); ?>


    <div class="d-grid gap-2 col-12 mx-auto">
        <?= Html::submitButton('ตกลง', ['class' => 'btn btn-block btn-primary mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
