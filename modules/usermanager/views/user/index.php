<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'ผู้ใช้งานระบบ';
$this->params['breadcrumbs'][] = $this->title;

$create = Html::a('<i class="fa-solid fa-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success']);

?>
<style>
#user-grid table thead {
    background-color: #fff;
}
#user-grid-container{
  height:480px;
}
</style>
<?=$this->render('../default/navlink');?>
<?php
$layout = <<< HTML
<div class="clearfix"></div>

<div class="row justify-content-between">
    <div class="col-4">
    <p>
        {$create}
    </p>
    </div>
    <div class="col-4">
    {$this->render('_search', ['model' =>$searchModel])}
    </div>
  </div>
  {items}
  {summary}
  {pager}


HTML;

?>
<?= GridView::widget([
  'id' => 'user-grid',
  'dataProvider' => $dataProvider,
  //   'filterModel' => $searchModel,
  'pjax' => true,
  'showHeader' => true,
  'showPageSummary' => false,
  'layout' => '{items}{pager}',
  'floatHeader' => true,
  'floatHeaderOptions' => ['scrollingTop' => '20'],
  'perfectScrollbar' => true,
  'footerRowOptions' => ['style' => 'font-weight:bold;text-decoration: underline; position: absolute'],
  'layout' => $layout,
  'columns' => [
    [
      'class'=>'kartik\grid\SerialColumn',
      'contentOptions'=>['class'=>'kartik-sheet-style'],
      'width'=>'36px',
      'pageSummary'=>'Total',
      'pageSummaryOptions' => ['colspan' => 6],
      'header'=>'',
      'headerOptions'=>['class'=>'kartik-sheet-style']
  ],
    [
      'attribute' => 'username',
      'header' =>'<i class="far fa-user"></i> | ชื่อเข้าใช้งาน',
      'value' => function ($model, $key, $index, $widget) {
          return $model->username;
      }
  ],
  [
    // 'attribute' => 'email',
    'header' =>'<i class="fas fa-address-card"></i> | ชื่อ-นามสกุล',
    'value' => function ($model, $key, $index, $widget) {
        return $model->fullname;
    }
],
    [
      'attribute' => 'status',
      'class' => 'kartik\grid\BooleanColumn',
      'vAlign' => 'middle',
      'header' => '<i class="fas fa-unlock-alt"></i> สถานะ',
      'format' => 'html',
      'filter' => $searchModel->itemStatus,
      'value' => function ($model) {
        return $model->statusName == 'Active' ? '<span class="text-success">' . $model->statusName . '</span>' : $model->statusName;
      }
    ],
    // 'created_at:dateTime',
    [
      'attribute' => 'created_at',
      'header' => '<i class="fas fa-calendar-alt"></i> สร้างเมื่อ',
      'format' => 'html',
      'filter' => $searchModel->itemStatus,
      'value' => function ($model) {
        return Yii::$app->thaiFormatter->asDateTime($model->created_at, 'short');
      }
    ],
    [
      'class' => 'app\modules\usermanager\grid\ActionColumn',
      'header' => '<center>ดำเนินการ<center>',
      'width' => '130px',
      'dropdown' => false,
      'vAlign' => 'middle',
    ],

  ],
]); ?>