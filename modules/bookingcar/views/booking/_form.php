<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'localtion_province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localtion_district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passengers_number')->textInput() ?>

    <?= $form->field($model, 'car_van')->textInput() ?>

    <?= $form->field($model, 'car_truck')->textInput() ?>

    <?= $form->field($model, 'car_sedan')->textInput() ?>

    <?= $form->field($model, 'car_bus')->textInput() ?>

    <?= $form->field($model, 'car_small_truck')->textInput() ?>

    <?= $form->field($model, 'passengers_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_name')->textInput() ?>

    <?= $form->field($model, 'contact_phone')->textInput() ?>

    <?= $form->field($model, 'rally_point')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

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
