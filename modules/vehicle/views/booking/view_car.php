<?php
use yii\helpers\Html;
?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 160px;
}
</style>
<div class="row g-0 border-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
    <div class="col-auto d-none d-lg-block">
    <div class="box-img" data-aos="fade-left">
        <?=Html::img(['/file', 'id' => $model->car->photo,['class' =>'bd-placeholder-img']])?>
         </div>
    </div>
        <div class="col d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><i class="fa-solid fa-file-pen"></i> <?=$model->title?></strong>
          <!-- <h3 class="mb-0">Featured post</h3> -->
          <p class="card-text" style="margin-bottom: 0px;"><i class="fa-solid fa-hourglass-start"></i> วันเวลาที่ออกเดินทาง 13/09/2565 เวลาเดินทางกลับ 13/09/2565 </p>
          <div class="mb-1 text-muted">
            ทะเบียน : <code><?=isset($model->car->data_json['car_regis']) ? $model->car->data_json['car_regis'] : null ?></code> | 
            ยี่ห้อ : <code><?=isset($model->car->data_json['band']) ? $model->car->data_json['band'] : null?></code> | 
            รุ่น : <code><?=isset($model->car->data_json['model']) ? $model->car->data_json['model'] : null?></code>
        </div>
        </div>
      </div>

