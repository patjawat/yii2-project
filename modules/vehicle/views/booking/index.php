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
</style>

<?php if(Yii::$app->user->can('admin')):?>
<h1>admin</h1>
<?php endif; ?>

<div class="booking-index">

    <div class="d-flex bd-highlight">
        <div class="p-2 bd-highlight">
        </div>
        <div class="ms-auto p-2 bd-highlight">
<?php if(Yii::$app->user->can('driver')):?>
    <?=Html::a('<i class="fa-solid fa-list-ul"></i> ทั้งหมด '.$status['allBadgeTotal'],['/vehicle/booking'],['class' => 'btn btn-info position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <?=Html::a('<i class="fa-solid fa-hourglass-start"></i> ขอใช้รถ'.$status['awaitBadgeTotal'],['/vehicle/booking','status'=> 'await'],['class' => 'btn btn-warning position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <?=Html::a('<i class="fa-solid fa-check"></i> อนุมัติ '.$status['approveBadgeTotal'],['/vehicle/booking','status'=> 'approve'],['class' => 'btn btn-primary position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


            <?=Html::a('<i class="fa-solid fa-check"></i> เสร็จสิ้น' .$status['successBadgeTotal'],['/vehicle/booking','status'=> 'success'],['class' => 'btn btn-success position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    
            <?=Html::a('<i class="fa-solid fa-xmark"></i> ยกเลิก '.$status['cancelBadgeTotal'],['/vehicle/booking','status'=> 'cancel'],['class' => 'btn btn-danger position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif; ?>   
    </div>
    </div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'header' => 'รายละเอียดการขอใช้ยานพาหนะ',
                'width' => '60%',
                'format' => 'raw',
                'value' => function($model){
                    return $this->render('view_car',['model' => $model]);
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
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => function($model){
                    return $this->render('action',['model' => $model]);
                }
            ]
            // [
            //     'class' => ActionColumn::className(),
            //     'hAlign' => 'center',
            //     'vAlign' => 'middle',
            //     'urlCreator' => function ($action, Booking $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>

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