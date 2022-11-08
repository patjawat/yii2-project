<?php

use app\modules\bookingcar\models\Category;
use app\modules\bookingcar\models\Booking;
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
            <th width="30%">รูปรถ</th>
            <th width="100px">รายการ</th>
            <th width="100">ดำเนินการ</th>
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
            $bookingCount = Booking::find()->where(['like', 'start', $start[0] . '%', false])
            ->andWhere(['car_id' => $model->id])
            ->count();
            ?>

        <tr class="align-middle" >
            <td><?=$i++;?></td>
            <td>
                <div class="box-img" data-aos="fade-right" data-aos-delay="<?=($delay++) * 100?>">
                    <?= Html::img(['/file','id'=>$model->id]) ?>
                </div>
               
            </td>
            <td>
            <?php // $model->data_json['band'];?>
           
            </td>
            <td>
            <?php if($bookingCount > 0): ?>
                <button type="button" class="btn btn-warning" disabled><i class="fa-solid fa-minus"></i> ไม่ว่าง</button>

                <?php else: ?>
                    <?= Html::a('<i class="fa-solid fa-check"></i> เลือก', ['/bookingcar/booking/create', 'car_id' => $model->id,'start' => $searchModel->start,'end' => $searchModel->end], ['class' => 'btn btn-primary']) ?>

                    <?php endif; ?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php Pjax::end(); ?>
