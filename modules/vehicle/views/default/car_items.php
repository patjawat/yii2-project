<?php

use app\modules\vehicle\models\Category;
use app\modules\vehicle\models\Booking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ประเภทรถ';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>

.box-img>img {
    width: 150px;
}
</style>


<?php Pjax::begin(); ?>
<table class="table no-wrap" style="
    position: relative;
">
    <thead>
        <tr>
            <th width="30px">#</th>
            <th width="80%">รายการ</th>
            <th width="30%">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            $delay = 3;
            ?>
        <?php foreach ($dataProviderCar->getModels() as $model):?>
            <?php
            $start = explode(' ',$searchModel->start);
            // $bookingCount = Booking::find()->where(['like', 'start', $start[0] . '%', false])
            $bookingCount = Booking::find()->where(['like', 'start', $start[0], false])
            ->andWhere(['car_id' => $model->id])
            ->andWhere(['<>','status_id','cancel'])
            ->count();
            ?>

        <tr class="align-middle" >
            <td><?=$i++;?></td>
            <td >
            <?=$this->render('view_car',['model'=>$model])?>
        
            </td>
            <td >
            <?php if($model->checkCar($searchModel->start,$searchModel->end,$model->id) > 0): ?>
                <button type="button" class="btn btn-warning" disabled><i class="fa-solid fa-minus"></i> ไม่ว่าง</button>

                <?php else: ?>
                    <?= Html::a('<i class="fa-solid fa-check"></i> เลือก', ['/vehicle/booking/create', 'car_id' => $model->id,'start' => $searchModel->start,'end' => $searchModel->end], ['class' => 'btn btn-success']) ?>

                    <?php endif; ?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php Pjax::end(); ?>
