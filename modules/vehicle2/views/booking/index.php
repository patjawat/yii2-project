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

table {
    background-color: #fff;
}
</style>
<?php Pjax::begin()?>
<div class="row justify-content-md-center">
    <div class="col-10">

    <div class="d-flex bd-highlight">
        <div class="p-2 bd-highlight">
        </div>
        <div class="ms-auto p-2 bd-highlight">
            <?php if (Yii::$app->user->can('driver')): ?>
            <?=Html::a('<i class="fa-solid fa-list-ul"></i> ทั้งหมด ' . $status['allBadgeTotal'], ['/vehicle2/booking'], ['class' => 'btn btn-light position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?=Html::a('<i class="fa-solid fa-hourglass-start"></i> ขอใช้รถ' . $status['awaitBadgeTotal'], ['/vehicle2/booking', 'status' => 'await'], ['class' => 'btn btn-light position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?=Html::a('<i class="fa-solid fa-check"></i> อนุมัติ ' . $status['approveBadgeTotal'], ['/vehicle2/booking', 'status' => 'approve'], ['class' => 'btn btn-light position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?=Html::a('<i class="fa-solid fa-check"></i> เสร็จสิ้น' . $status['successBadgeTotal'], ['/vehicle2/booking', 'status' => 'success'], ['class' => 'btn btn-light position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?=Html::a('<i class="fa-solid fa-xmark"></i> ยกเลิก ' . $status['cancelBadgeTotal'], ['/vehicle2/booking', 'status' => 'cancel'], ['class' => 'btn btn-light position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php endif;?>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'kartik\grid\SerialColumn',
            'width' => '36px',
            'pageSummary' => 'Total',
            'pageSummaryOptions' => ['colspan' => 6],
            'header' => '#',
        ],
        [
            'header' => 'เรื่อง',
            'vAlign' => 'middle',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->title;
            },
        ],

        [
            'header' => 'ผู้ขอใช้',
            'vAlign' => 'middle',
            'width' => '100px',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->data_json['fullname'];
            },
        ],
        [
            'header' => 'ยานพาหนะ',
            'vAlign' => 'middle',
            'width' => '100px',
            // 'width' => '40%',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->car->data_json['car_regis'];
            },
        ],
        [
            'header' => 'ผู้ขับ',
            'vAlign' => 'middle',
            // 'width' => '40%',
            'format' => 'raw',
            'value' => function ($model) {
                return isset($model->driver) ? $model->driver->fullname : '-';
            },
        ],

        [
            'header' => 'วันออกเดินทาง',
            'width' => '150px',
            'format' => 'raw',
            'vAlign' => 'middle',
            'value' => function ($model) {
                return $model->start;
            },
        ],

        [
            'attribute' => 'status_id',
            'format' => 'raw',
            'header' => 'สถานะ',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function ($model) {
                // return isset($model->status) ? $model->status->title : '-';
                return $this->render('booking_status', ['model' => $model]);

            },
        ],
        [
            'header' => 'ดำเนินการ',
            'format' => 'raw',
            'width' => '280px',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value' => function ($model) {
                return $this->render('action', ['model' => $model]);
            },
        ],
        // [
        //     'class' => ActionColumn::className(),
        //     'hAlign' => 'center',
        //     'vAlign' => 'middle',
        //     'urlCreator' => function ($action, Booking $model, $key, $index, $column) {
        //         return Url::toRoute([$action, 'id' => $model->id]);
        //      }
        // ],
    ],
]);?>

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
<?php Pjax::end()?>