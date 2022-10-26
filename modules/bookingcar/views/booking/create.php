<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = 'แผนการจองยานพาหนะ';
$this->params['breadcrumbs'][] = ['label' => 'จองยานพาหนะ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
