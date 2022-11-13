<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'localtion_province') ?>

    <?= $form->field($model, 'localtion_district') ?>

    <?= $form->field($model, 'passengers_number') ?>

    <?= $form->field($model, 'car_van') ?>

    <?php // echo $form->field($model, 'car_truck') ?>

    <?php // echo $form->field($model, 'car_sedan') ?>

    <?php // echo $form->field($model, 'car_bus') ?>

    <?php // echo $form->field($model, 'car_small_truck') ?>

    <?php // echo $form->field($model, 'passengers_name') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_phone') ?>

    <?php // echo $form->field($model, 'rally_point') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'time_start') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'stopover') ?>

    <?php // echo $form->field($model, 'cost_type') ?>

    <?php // echo $form->field($model, 'person_name') ?>

    <?php // echo $form->field($model, 'certifier_name') ?>

    <?php // echo $form->field($model, 'certifier_position') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'author_position') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'receive') ?>

    <?php // echo $form->field($model, 'driver') ?>

    <?php // echo $form->field($model, 'car_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
