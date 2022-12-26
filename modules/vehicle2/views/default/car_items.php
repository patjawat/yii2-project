<?php

use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\Category;
use yii\helpers\Html;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .box-img {
    position: relative;
    width: 200px;
    height: 100px;
    /* background-color: #e112a0; */
}

.box-img>img {
    width: 200px;
    max-width: 140px;
}
</style>
<?php Pjax::begin();?>


<?php foreach ($dataProviderCar->getModels() as $model): ?>
    <div class="row align-items-center mb-4 rounded-3 shadow" style="background-color: #fff;margin-buttom:3px;">
        <div class="col-3">
        <div class="box-img">
            <?php echo  Html::img(['/file', 'id' => $model->photo,['class' =>'bd-placeholder-img']])?>
        </div>
        </div>
        <div class="col-7">
        <p style="margin-bottom: 0px;">
                ทะเบียน :
                <code><?=isset($model->data_json['car_regis']) ? $model->data_json['car_regis'] : null ?></code>
            </p>
            <p>
                ยี่ห้อ : <code><?=isset($model->data_json['band']) ? $model->data_json['band'] : null?></code> |
                รุ่น : <code><?=isset($model->data_json['model']) ? $model->data_json['model'] : null?></code>
            </p>
        </div>
        <div class="col-2">
        <?php if ($model->checkCar($searchModel->start, $searchModel->end, $model->id) > 0): ?>
                <button type="button" class="btn btn-warning" disabled><i class="fa-solid fa-minus"></i>
                    ไม่ว่าง</button>

                <?php else: ?>
                <?=Html::a('<i class="fa-solid fa-check"></i> เลือก', ['/vehicle2/booking/create', 'car_id' => $model->id, 'start' => $searchModel->start, 'end' => $searchModel->end], ['class' => 'btn btn-success'])?>

                <?php endif;?>
        </div>

</div>

    <?php endforeach;?>

<?php Pjax::end();?>