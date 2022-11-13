<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\Category $model */


$this->params['breadcrumbs'][] = 'Profile';
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
        <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="row">
    <div class="col-6">
    <div data-aos="fade-up">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
               'username',
               'fullname',
               'email'
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
