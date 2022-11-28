<?php
use yii\helpers\Html;
?>
<style>
.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 100px;
}
</style>
<div class="row g-0 border-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
    <div class="col-3 d-none d-lg-block">
    <div class="box-img" data-aos="fade-left">
        <?= isset($model->car) ? Html::img(['/file', 'id' => $model->car->photo,['class' =>'bd-placeholder-img']]) : ''?>
         </div>
    </div>
        <div class="col d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><i class="fa-solid fa-file-pen"></i> <?=$model->title?></strong>
          <!-- <h3 class="mb-0">Featured post</h3> -->
          <p class="card-text" style="margin-bottom: 0px;"><i class="fa-solid fa-down-left-and-up-right-to-center"></i> วันเวลาไป <code><?=$model->start;?></code>  วันเวลากลับ <code><?=$model->end;?></code></p>
          <div class="mb-1 text-muted">
            ทะเบียน : <b><?=isset($model->car->data_json['car_regis']) ? $model->car->data_json['car_regis'] : null ?></b> | 
            ยี่ห้อ : <b><?=isset($model->car->data_json['band']) ? $model->car->data_json['band'] : null?></b> | 
            รุ่น : <b><?=isset($model->car->data_json['model']) ? $model->car->data_json['model'] : null?></b>
        </div>
        <div class="d-flex justify-content-between">

            <p class="card-text" style="margin-bottom: 0px;"><i class="fa-solid fa-user-tie"></i> ผู้ขอใช้รถ : <?=isset($model->data_json['fullname']) ? $model->data_json['fullname'] : '-'?></p>
            <p class="card-text" style="margin-bottom: 0px;"><i class="fa-solid fa-user-tie"></i> ผู้ขับ : <?=isset($model->driver) ? $model->driver->fullname : '-'?></p>
            
        </div>
        </div>
      </div>

