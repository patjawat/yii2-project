<?php

use app\modules\bookingcar\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ประเภทรถ';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
table {
    white-space: nowrap;
    border-collapse: separate;
    border-spacing: 0 10px;

}

.table {
    position: relative;
    border-collapse: separate;
    border-spacing: 0 10px;

}

.table td,
.table th,
.table tr,
.table thead,
.table tbody {
    border: none;
    position: relative;
}

.table thead th {
    border: none;
    padding-top: 0;
    padding-bottom: 0;
}

tbody {
    position: relative;

}

tbody tr {
    border-radius: 8px;
    margin-bottom: 200px;
    position: relative;
    height: 50px;
}

tbody tr::after {
    content: '';
    width: 100%;
    position: absolute;
    left: 0;
    right: 0;
    // background-color: #fff;
    /* background-color: #f1f2f5; */
    background-color: #dbdfe4;
    height: 80px;
    z-index: 0;
    border-radius: 8px;
}

tbody td {
    z-index: 1;
}

.box-img {
    position: relative;
    /* width:500px; */
}

.box-img>img {
    width: 200px;
}
</style>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php Pjax::begin(); ?>
<table class="table no-wrap" style="
    position: relative;
">
    <thead>
        <tr>
            <th>#</th>
            <th width="200px">รูปรถ</th>
            <th width="80%">รายการ</th>
            <th width="100">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            $delay = 3;
            ?>
        <?php foreach ($dataProvider->getModels() as $model):?>
        <tr class="align-middle" >
            <td><?=$i++;?></td>
            <td>
                <div class="box-img" data-aos="fade-right" data-aos-delay="<?=($delay++) * 100?>">
                    <?= Html::img(['/file','id'=>$model->id]) ?>
                </div>
               
            </td>
            <td>
            <?=$model->data_json['band'];?>
            </td>
            <td>

            <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa-solid fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
              
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php Pjax::end(); ?>
