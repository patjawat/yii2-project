<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'การจอง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
    .driver-profile {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 20px;
}

.card-driver {
    border-radius: 50%;
    width: 116px;
    height: 116px;
    position: absolute;
    top: -10;
    box-shadow: 0px 5px 50px 0px #084298, 0px 0px 0px 2px rgb(107 74 255 / 50%);
    
}
</style>
<div class="row">
    <div class="col-8">
        
<p>
        <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa-solid fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
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
            [
                'group'=>true,
                'label'=> '<i class="fa-solid fa-list-check"></i> วัตถุประสงค์การจอง : <code>'.$model->title.'</code>',
                'rowOptions'=>['class'=>'table-info']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'status_id', 
                        'label' =>'สถานะ',
                        'format'=>'raw', 
                        'value'=>$model->status->title
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'start', 
                        'lable' => 'วันเวลาออกเดินทาง',
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'title',
                        'label' =>'จุดหมายปลายทาง',
                        'format'=>'raw', 
                        'value'=> isset($model->data_json['point']) ? $model->data_json['point'] : null,
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id',
                        'label' =>'ผู้จอง',
                        'format'=>'raw', 
                        'value'=> isset($model->data_json['fullname']) ? $model->data_json['fullname'] : null,
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id',
                        'label' =>'โทรศัพท์',
                        'format'=>'raw', 
                        'value'=> isset($model->data_json['phone']) ? $model->data_json['phone'] : null,
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id',
                        'label' =>'จำนวนผู้โดยสาร',
                        'format'=>'raw', 
                        'value'=> isset($model->data_json['passenger_number']) ? $model->data_json['passenger_number'] : null,
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'car_id',
                        'label' =>'พนักงานขับรถ',
                        'format'=>'raw', 
                        'value'=> $model->driverName(),
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'car_id',
                        'label' =>'เลขทะเบียน',
                        'format'=>'raw', 
                        'value'=> $model->car->data_json['car_regis'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'car_id',
                        'label' =>'ยี่ห้อ',
                        'format'=>'raw', 
                        'value'=> $model->car->data_json['band'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'car_id',
                        'label' =>'รุ่น',
                        'format'=>'raw', 
                        'value'=> $model->car->data_json['model'],
                    ],
                ],
            ],
            
        ],
    ]) ?>

    </div>
    <div class="col-4">

<div class="card border-0 mt-5" style="width:100%;">
<div class="driver-profile">
<?= $model->driver_id == null  ?  null : Html::img(['/file', 'id' => $model->driver_id], ['class' => 'card-driver', 'id' => 'driver-photo','style' => $model->isNewRecord ? 'display:none' : ''])?>
                <?php // Html::img(['/file', 'id' => $model->driver_id], ['class' => 'card-driver', 'id' => 'driver-photo'])?>
            </div>
            <br><br>
    <?=Html::img(['/file', 'id' => $model->car_id, ['class' => 'card-img-top']])?>

</div>

</div>
</div>
