<?php

use app\modules\vehicle\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ประเภทรถ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
<h1><?=$this->title?></h1>
<div class="row justify-content-between">
    <div class="col-4">
    <p>
        <?= Html::a('<i class="fa-solid fa-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <div class="col-4">
        <?=$this->render('_search', ['model' => $searchModel]); ?>
    </div>
  </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'label' => 'รายการ',
                'value' => function ($model) {
                   return  $model->title;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'header' => 'ดำเนินการ',
                'headerOptions' => ['style' => 'width:120px'],
                'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
