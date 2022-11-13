<?php

use app\modules\bookingcar\models\Booking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\BookingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'localtion_province',
            'localtion_district',
            'passengers_number',
            'car_van',
            //'car_truck',
            //'car_sedan',
            //'car_bus',
            //'car_small_truck',
            //'passengers_name:ntext',
            //'contact_name',
            //'contact_phone',
            //'rally_point',
            //'date_start',
            //'time_start',
            //'title:ntext',
            //'description:ntext',
            //'stopover:ntext',
            //'cost_type',
            //'person_name',
            //'certifier_name',
            //'certifier_position',
            //'author_id',
            //'author_position',
            //'date_end',
            //'time_end',
            //'receive',
            //'driver:ntext',
            //'car_id:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Booking $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
