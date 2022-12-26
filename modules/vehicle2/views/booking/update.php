<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = 'แก้ไขการจอง';
$this->params['breadcrumbs'][] = ['label' => 'การจอง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="booking-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'driver' => $driver
    ]) ?>

</div>




