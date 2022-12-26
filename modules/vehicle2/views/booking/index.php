<?php

use app\components\BookingHelper;
use dominus77\sweetalert2\assets\ThemeAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
ThemeAsset::register($this, ThemeAsset::THEME_MATERIAL_UI);
$status = BookingHelper::CountByStatus();

$this->title = 'รายการขอใช้ยานพาหนะ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td>img {
    width: 100px;
}

/* table {
    background-color: #fff;
} */


table {
    white-space: nowrap;
    border-collapse: separate;
    border-spacing: 0 10px;

}

.table {
    position: relative;
    border-collapse: separate;
    border-spacing: 0 10px;

}

.table td,
.table th,
.table tr,
.table thead,
.table tbody {
    border: none;
    position: relative;
}

.table thead th {
    border: none;
    padding-top: 0;
    padding-bottom: 0;
}

tbody {
    position: relative;

}

tbody tr {
    border-radius: 8px;
    margin-bottom: 200px;
    position: relative;
    height: 50px;
}

tbody tr::after {
    content: '';
    width: 100%;
    position: absolute;
    left: 0;
    right: 0;
    // background-color: #fff;
    background-color: #dbdfe4;
    height: 120px;
    z-index: 0;
    border-radius: 8px;
}

tbody td {
    z-index: 1;
}
</style>
<?php if(Yii::$app->user->can('driver')):?>
    <div class="row justify-content-md-center">
    <div class="col-10" style="padding-left: 0px;">
<div class="d-flex justify-content-start mb-3">
    <div class="p-2"> <?=Html::a('<i class="fa-solid fa-list-ul"></i> ทั้งหมด '.$status['allBadgeTotal'],['/vehicle2/booking'],['class' => 'btn btn-light position-relative'])?></div>
    <div class="p-2"><?=Html::a('<i class="fa-solid fa-hourglass-start"></i> ขอใช้รถ'.$status['awaitBadgeTotal'],['/vehicle2/booking','status'=> 'await'],['class' => 'btn btn-light position-relative'])?></div>
    <div class="p-2"><?=Html::a('<i class="fa-solid fa-check"></i> อนุมัติ '.$status['approveBadgeTotal'],['/vehicle2/booking','status'=> 'approve'],['class' => 'btn btn-light position-relative'])?></div>
    <div class="p-2"><?=Html::a('<i class="fa-solid fa-check"></i> เสร็จสิ้น' .$status['successBadgeTotal'],['/vehicle2/booking','status'=> 'success'],['class' => 'btn btn-light position-relative'])?></div>
    <div class="p-2"><?=Html::a('<i class="fa-solid fa-xmark"></i> ยกเลิก '.$status['cancelBadgeTotal'],['/vehicle2/booking','status'=> 'cancel'],['class' => 'btn btn-light position-relative'])?></div>

  </div>
  </div>
  </div>
  <?php endif; ?>   

  
<div class="row justify-content-md-center">
    <div class="col-10">

        <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="row d-flex justify-content-between align-items-center mb-4 p-3 rounded-3 shadow" style="background-color: #fff;margin-buttom:3px;height: 75px;
">
            <div class="col-3">
                <p class="mb-0">เรื่อง : <span class="text-success"><?=$model->title;?></span></p>
        <p class="mb-0">
        ผู้ขอใช้ : <span class="text-success"><?=$model->data_json['fullname']?></span>
        </p>
            </div>
            <div class="col-1">
                <?=$model->car->data_json['car_regis']?>
            </div>
            <div class="col-2">
                <?=isset($model->driver) ? $model->driver->fullname : '-'?>
            </div>
            <div class="col-2">
                <?=$model->start;?>
            </div>
            <div class="col-1">
                <?=$this->render('booking_status',['model' => $model])?>
            </div>
            <div class="col-3">
<?=$this->render('action',['model' => $model])?>
            </div>
        </div>
        <?php endforeach;?>
        
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
$this->registerJs($js, View::POS_END)
?>