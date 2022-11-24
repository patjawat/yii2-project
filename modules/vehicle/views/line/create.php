<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = 'เพิ่มการจอง';

?>
<div class="booking-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'car_id' => $car_id,
    ]) ?>

</div>
