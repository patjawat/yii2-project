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
$status = BookingHelper::CountByStatusDriver();


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

            <?=Html::a('<i class="fa-solid fa-check"></i> อนุมัติ '.$status['approveBadgeTotal'],['/vehicle/myjob','status'=> 'approve'],['class' => 'btn btn-primary position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?=Html::a('<i class="fa-solid fa-check"></i> เสร็จสิ้น' .$status['successBadgeTotal'],['/vehicle/myjob','status'=> 'success'],['class' => 'btn btn-success position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    </div>
    </div>


    <?php Pjax::begin(); ?>
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
                    return $this->render('../booking/view_car',['model' => $model]);
                }
            ],
            [
                'header' => 'เลขไมค์เริ่ม',
                'width' => '50px',
                'format' => 'raw',
                'value' => function($model){
                    return isset($model->data_json['mileage_start']) ? $model->data_json['mileage_start'] :'-';
                }
            ],
            [
                'header' => 'เลขไมค์สิ้นสุด',
                'width' => '50px',
                'format' => 'raw',
                'value' => function($model){
                    return isset($model->data_json['mileage_end']) ? $model->data_json['mileage_end'] :'-';
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
                    return $this->render('../booking/booking_status',['model' => $model]);

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

    <?php Pjax::end(); ?>

</div>

<?php 

$js = <<< JS

$('#main-modal').modal('show');

$('.dis_cancel').click(function (e) { 
    e.preventDefault();
    console.log('Calcel')
    Swal.fire(
  'ไม่สามารถยกเลิกได้!',
  'เนื่องจากอนุมัติแล้วกรุณาติดต่อผู้กูแลระบบ!',
  'warning'
)    
});

JS;
$this->registerJs($js,View::POS_END)
?>