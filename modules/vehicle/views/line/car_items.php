<?php

use app\modules\vehicle\models\Category;
use app\modules\vehicle\models\Booking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<style>
.box-img>img {
    width: 100%;
}
body{
  padding: 2rem 0rem;
}
.image-parent {
  max-width: 100px;
}
</style>

<br>
<?php Pjax::begin(); ?>

<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 col-lg-5">
      <!-- <h6 class="text-muted">List Group with Images</h6>  -->
      <ul class="list-group">

      <?php foreach ($dataProviderCar->getModels() as $model):?>
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 shadow-md mb-3 bg-body-tertiary rounded">
          <div class="flex-column">
         <?=$model->data_json['car_regis']?>
            <p><small>ยี่ห้อ : <?=$model->data_json['band']?> รุ่น : <?=$model->data_json['model']?></small></p>
            <?php if($model->checkCar($searchModel->start,$searchModel->end,$model->id) > 0): ?>
                <button type="button" class="btn btn-warning" disabled><i class="fa-solid fa-minus"></i> ไม่ว่าง</button>

                <?php else: ?>
                    <?= Html::a('<i class="fa-solid fa-check"></i> จอง', ['/vehicle/line/create', 'car_id' => $model->id,'start' => $searchModel->start,'end' => $searchModel->end], ['class' => 'btn btn-success']) ?>

                    <?php endif; ?>
            <span class="badge badge-info badge-pill"> 2 Copies in Stock</span>
          </div>
          
          <div class="image-parent box-img">
        <?=Html::img(['/file', 'id' => $model->photo,['class' =>'bd-placeholder-img']])?>
          </div>
        </div>
       
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>


<?php 
            $i = 1;
            $delay = 3;
            ?>




<?php Pjax::end(); ?>