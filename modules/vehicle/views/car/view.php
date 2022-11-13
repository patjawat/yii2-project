<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
    .box-img{
        position: relative;
        /* width:500px; */
    }
    .box-img > img{
        width:500px;
    }
</style>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p data-aos="fade-up">
        <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa-solid fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
    <div class="col-6">
    <div data-aos="fade-up">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => 'ยี่ห้อ',
                    'value' => $model->data_json['band'],
                ],
                [
                    'label' => 'รุ่น',
                    'value' => $model->data_json['model'],
                ],
                [
                    'label' => 'ทะเบียน',
                    'value' => $model->data_json['car_regis'],
                ],
            ],
            ]) ?>
            </div>
</div>
<div class="col-6">
        <div class="box-img" data-aos="fade-left">
            <?= Html::img(['/file','id'=>$model->id]) ?>
        </div>
    </div>
    </div>

</div>
