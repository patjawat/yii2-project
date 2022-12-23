<?php

use app\modules\vehicle\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
/** @var yii\web\View $this */
/** @var app\modules\vehicle\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ห้องประชุม';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>

.box-img {
    position: relative;
    width: 186px;
}

.box-img>img {
    max-width: 176px;
}
</style>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php Pjax::begin(); ?>
<table class="table no-wrap" style="
    position: relative;
">
    <thead>
        <tr>
            <th width="36px">#</th>
            <th width="200px">รูปรถ</th>
            <th>รายการ</th>
            <th width="200">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            $delay = 3;
            ?>
        <?php foreach ($dataProvider->getModels() as $model):?>
        <tr class="align-middle">
            <td><?=$i++;?></td>
            <td>
                <div class="box-img">
                    <?= Html::img(['/file','id'=>$model->photo]) ?>
                </div>

            </td>
            <td>
                <?=$model->data_json['room_name'];?>
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