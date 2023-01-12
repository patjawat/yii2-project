<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$site = app\components\SiteHelper::Info();

$this->title = 'จองรถ';
$this->params['breadcrumbs'][] = ['label' => $site['site_name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <?= $this->render('_form', [
        'model' => $model,
        'car_id' => $car_id,
    ]) ?>

</div>
