<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = 'จองรภ';

?>
<div class="booking-create">

    <?= $this->render('_form', [
        'model' => $model,
        'car_id' => $car_id,
    ]) ?>

</div>
