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
?>
<style>
td>img {
    width: 100px;
}
table {
    background-color: #fff;
}
.product-description {
    color: #6c757d;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
<?php Pjax::begin()?>
<div class="booking-index">


<div class="row">


<?php foreach($dataProvider->getModels() as $model):?>
    <div class="col-sm-6">
    <div class="card border-0 shadow-md mb-3 bg-body-tertiary rounded">
      <div class="card-body">
        <h6 class="card-title product-description"><i class="fa-solid fa-book-open-reader"></i> <?= $model->title;?><span class="text-danger"> อนุมัติ</span></h6>
        <p class="card-text"><i class="fa-regular fa-calendar-days"></i> <span class="badge text-bg-warning"><?= $model->start;?></span>  <i class="fa-solid fa-arrow-right-to-bracket"></i>   <span class="badge text-bg-success"><?= $model->end;?></span></p>
        <div class="d-flex">

        <!-- Flex -->
  <div class="p-0">
      <!-- <a href="#" class="btn btn-primary"><i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...</a> -->
      <?=Html::a('<i class="fa-regular fa-hand-pointer"></i> เพิ่มเติม...',['/vehicle/line/view','id' => $model->id],['class' => 'btn btn-primary']);?>
  </div>
  <div class="ms-auto p-2">
    สถานะ : <?=$this->render('booking_status',['model'=>$model])?>
      <!-- <a href="#" class="btn btn-primary">เพิ่มเติม...</a> -->
  </div>
</div>
<!-- End Flex -->
      </div>
    </div>
  </div>

  <?php endforeach; ?>
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
<?php Pjax::end()?>