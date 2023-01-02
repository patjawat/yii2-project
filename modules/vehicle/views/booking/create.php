<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$site = app\components\SiteHelper::Info();

$this->title = 'เพิ่มการจอง';
$this->params['breadcrumbs'][] = ['label' => $site['site_name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'car_id' => $car_id,
    ]) ?>

</div>
