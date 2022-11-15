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
        <?=Html::img(['/file', 'id' => $model->photo,['class' =>'bd-placeholder-img']])?>
         </div>
    </div>
        <div class="col d-flex flex-column position-static">
          <div class="mb-1 text-muted">
            <p style="margin-bottom: 0px;">
                ทะเบียน : <code><?=isset($model->data_json['car_regis']) ? $model->data_json['car_regis'] : null ?></code> 
            </p>
            <p>
                ยี่ห้อ : <code><?=isset($model->data_json['band']) ? $model->data_json['band'] : null?></code> | 
                รุ่น : <code><?=isset($model->data_json['model']) ? $model->data_json['model'] : null?></code>
            </p>
        </div>
        </div>
      </div>

