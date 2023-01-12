<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */
$site = app\components\SiteHelper::Info();

$this->title = 'แก้ไขการจอง';
$this->params['breadcrumbs'][] = ['label' => $site['site_name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="booking-update">

    <?= $this->render('_form', [
        'model' => $model,
        'driver' => $driver
    ]) ?>

</div>




