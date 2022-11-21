<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\web\View;
use dominus77\sweetalert2\assets\ThemeAsset;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);

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
    /* border-radius: 50%;
    width: 116px;
    height: 116px;
    position: absolute;
    top: -10;
    box-shadow: 0px 5px 50px 0px #084298, 0px 0px 0px 2px rgb(107 74 255 / 50%); */
    
}
</style>
<div class="row">
    <div class="col-8">
        
<p>
        <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
       
        <?php if($model->status_id == 'approve'):?>
            <?= Html::a('<i class="fa-solid fa-ban"></i> ยกเลิกการจอง', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-secondary dis_cancel',
        ]) ?>
            <?php else :?>
    <?= Html::a('<i class="fa-solid fa-ban"></i> ยกเลิกการจอง', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
        ]) ?>
        <?php endif;?>

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
                        'value'=> $model->status->title.' '.($model->status_id == 'approve' ? '<i class="fa-solid fa-check text-success"></i>' : '')
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
            [
                'columns' => [
                    [
                        'attribute'=>'driver_id', 
                        'label' =>'ภาพพนักงานขับรถ',
                         'format' => ['image',['width'=>'100','height'=>'100']],
                        'value' => isset($model->driver) ? ['/file?id='.$model->driver->photo] :''
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'driver_id', 
                        'label' =>'พนักงานขับรถ',
                        'format'=>'raw', 
                        'value'=> $model->driverName(),
                    ],
                ],
            ],
            
        ],
    ]) ?>

    </div>
    <div class="col-4">

<div class="card border-0 mt-5" style="width:100%;">

<?=Html::img(['/file', 'id' => $model->car->photo, ['class' => 'card-img-top']])?>

</div>


</div>
</div>



<?php 

$js = <<< JS

$('.dis_cancel').click(function (e) { 
    e.preventDefault();
    console.log('Calcel')
    Swal.fire(
  'ไม่สามารถยกเลิกได้!',
  'เนื่องจากอนุมัติแล้วกรุณาติดต่อผู้กูแลระบบ!',
  'warning'
)    
});
function CancelWarnings() {
  
}
JS;
$this->registerJs($js,View::POS_END)
?>