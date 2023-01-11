<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\web\View;
use yii\helpers\Url;
use app\components\UserHelper;
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
table {
    background-color: #fff;
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
<?php if ( ( $model->status_id == 'await' ) || ( $model->status_id == 'allocate') || ( $model->status_id == 'approve') ):?>
    <?php //if(Yii::$app->user->can('driver')):?>
    <?= $model->driver_id == '' ? Html::a('<i class="far fa-edit"></i> รับภาระกิจ', ['confirm-job', 'id' => $model->id], ['class' => 'btn btn-info','id' => 'confirm-job']):'' ?>
    <?php if(Yii::$app->user->identity->id == $model->created_by):?>
    <?php  Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning','style' => 'margin-right: 5px;']) ?>

        <?php endif;?>
   <?php else:?>
    <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning','style' => 'margin-right: 5px;']) ?>
    <?php endif;?>
    <?php // endif; ?>

<?= Html::a('<i class="fa-regular fa-pen-to-square"></i> พิมพ์ใบเบิกค่าเดินทาง', ['document', 'id' => $model->id], ['class' => 'btn btn-success',[
    'data' => ['pjax' => false]
    ]]) ?>
       
       <?php if($model->status_id == 'success' || $model->status_id == 'cancel'):?>
            <?= Html::a('<i class="fa-solid fa-ban"></i> ยกเลิกการจอง', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-secondary dis_cancel',
        ]) ?>
            <?php else :?>
    <?= Html::a('<i class="fa-solid fa-ban"></i> ยกเลิกการจอง', ['cancel', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
                        'attribute'=>'end', 
                        'lable' => 'วันเวลากลับ',
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
                        'value' => isset($model->driver->photo) ? ['/file?id='.$model->driver->photo] :'@web/images/driver.png'
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
$ConfirmUrl = Url::to(['/vehicle/booking/confirm-job']);
$userConfirm = UserHelper::getUser('fullname');
$js = <<< JS
$('#confirm-job').click(function (e) { 
    e.preventDefault();
     
Swal.fire({
  title: 'ยืนยันรับภาระกิจ?',
  text: "$userConfirm!",
  icon: 'warning',
  showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่,ยืนยัน!',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
        type: "get",
        url: "$ConfirmUrl",
        data:{id:$model->id},
        dataType: "json",
        success: function (response) {
            console.log(response)
        }
    });
  }
})
    
});

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