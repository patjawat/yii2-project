<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="booking-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'localtion_province',
            'localtion_district',
            'passengers_number',
            'car_van',
            'car_truck',
            'car_sedan',
            'car_bus',
            'car_small_truck',
            'passengers_name:ntext',
            'contact_name',
            'contact_phone',
            'rally_point',
            'date_start',
            'time_start',
            'title:ntext',
            'description:ntext',
            'stopover:ntext',
            'cost_type',
            'person_name',
            'certifier_name',
            'certifier_position',
            'author_id',
            'author_position',
            'date_end',
            'time_end',
            'receive',
            'driver:ntext',
            'car_id:ntext',
        ],
    ]) ?>

</div>
