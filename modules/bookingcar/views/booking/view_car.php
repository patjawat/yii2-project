<?php
use yii\helpers\Html;
?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 200px;
}
</style>
<div class="row g-0 border-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
    <div class="col-auto d-none d-lg-block">
    <div class="box-img" data-aos="fade-left">
        <?=Html::img(['/file', 'id' => $model->car_id,['class' =>'bd-placeholder-img']])?>
         </div>
    </div>
        <div class="col d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><i class="fa-solid fa-file-pen"></i> <?=$model->title?></strong>
          <!-- <h3 class="mb-0">Featured post</h3> -->
          <p class="card-text"><i class="fa-solid fa-hourglass-start"></i> วันเวลาที่ออกเดินทาง 13/09/2565 เวลาเดินทางกลับ 13/09/2565 </p>
          <div class="mb-1 text-muted">ทะเบียน : <code><?=($model->car->data_json['car_regis'])?></code> | ยี่ห้อ : <code><?=$model->car->data_json['band']?></code> | รุ่น : <code><?=$model->car->data_json['model']?></code> </div>
        </div>
      </div>

