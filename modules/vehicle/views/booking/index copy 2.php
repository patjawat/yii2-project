<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use app\modules\vehicle\models\Booking;
use app\components\BookingHelper;
use dominus77\sweetalert2\assets\ThemeAsset;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);
$status = BookingHelper::CountByStatus();


$this->title = 'รายการขอใช้ยานพาหนะ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td>img {
    width: 100px;
}
table {
    background-color: #fff;
}

</style>
<?php Pjax::begin()?>
<div class="booking-index">

<?=$this->render('booking_box',['status' => $status]);?>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="text-body bg-body shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'kartik\grid\SerialColumn',
                'width'=>'36px',
                'pageSummary'=>'Total',
                'pageSummaryOptions' => ['colspan' => 6],
                'header'=>'#',
            ],
            [
                'header' => 'เรื่อง',
                'vAlign' => 'middle',
                'format' => 'raw',
                'value' => function($model){
                    return $model->title;
                }
            ],

           
            
            [
                'header' => 'ผู้ขอใช้',
                'vAlign' => 'middle',
                'width' => '100px',
                'format' => 'raw',
                'value' => function($model){
                    return isset($model->data_json['fullname']) ? $model->data_json['fullname'] : '-';
                }
            ],
            [
                'header' => 'ยานพาหนะ',
                'vAlign' => 'middle',
                'width' => '100px',
                // 'width' => '40%',
                'format' => 'raw',
                'value' => function($model){
                    return isset($model->car->data_json['car_regis']) ? $model->car->data_json['car_regis'] : '-';
                }
            ],
            [
                'header' => 'ผู้ขับ',
                'vAlign' => 'middle',
                // 'width' => '40%',
                'format' => 'raw',
                'value' => function($model){
                    return isset($model->driver) ? $model->driver->fullname : '-';
                }
            ],
            
            
            
            [
                'header' => 'วันออกเดินทาง',
                'width' => '150px',
                'format' => 'raw',
                'vAlign' => 'middle',
                'value' => function($model){
                    return $model->start;
                }
            ],
            
            [
                'attribute' =>'status_id',
                'format' =>'raw',
                'header' => 'สถานะ',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => function($model){
                    // return isset($model->status) ? $model->status->title : '-';
                    return $this->render('booking_status',['model' => $model]);

                }
            ],
            [
                'header' => 'ดำเนินการ',
                'format' =>'raw',
                 'width' => '400px',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => function($model){
                    return $this->render('action',['model' => $model]);
                }
            ]
        ],
    ]); ?>

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

$('.dis_edit').click(function (e) { 
    e.preventDefault();
    console.log('Calcel')
    Swal.fire(
  'ไม่สามารถแก้ไขได้!',
  'เนื่องจากไม่ใช่เจ้าของเรื่อง!',
  'warning'
)    
});
function CancelWarnings() {
  
}
JS;
$this->registerJs($js,View::POS_END)
?>
<?php Pjax::end()?>