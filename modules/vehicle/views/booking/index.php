<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\modules\vehicle\models\Booking;


$this->title = 'รายการขอใช้ยานพาหนะ';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td>img {
    width: 100px;
}
</style>

<div class="booking-index">

    <div class="d-flex bd-highlight">
        <div class="p-2 bd-highlight">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="ms-auto p-2 bd-highlight">

            <?=Html::a('<i class="fa-solid fa-hourglass-start"></i> ขอใช้รถ   <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    8
    <span class="visually-hidden">unread messages</span>
  </span>',['/'],['class' => 'btn btn-warning position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <?=Html::a('<i class="fa-solid fa-check"></i> อนุมัติ <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    8
    <span class="visually-hidden">unread messages</span>',['/'],['class' => 'btn btn-primary position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


            <?=Html::a('<i class="fa-solid fa-check"></i> เสร็จสิ้น <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    8
    <span class="visually-hidden">unread messages</span>',['/'],['class' => 'btn btn-success position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    
            <?=Html::a('<i class="fa-solid fa-xmark"></i> ยกเลิก <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    8
    <span class="visually-hidden">unread messages</span>',['/'],['class' => 'btn btn-danger position-relative'])?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                    return $this->render('view_car',['model' => $model]);
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
                    return $this->render('booking_status',['model' => $model]);

                }
            ],
            [
                'class' => ActionColumn::className(),
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'urlCreator' => function ($action, Booking $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>