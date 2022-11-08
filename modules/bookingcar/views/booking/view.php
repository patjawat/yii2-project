<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\bookingcar\models\Booking $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'การจอง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-8">
        
<p>
        <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa-solid fa-trash"></i> ลบทิ้ง', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'group'=>true,
                'label'=> '<i class="fa-solid fa-list-check"></i> วัตถุประสงค์การจอง : <code>'.$model->title.'</code>',
                'rowOptions'=>['class'=>'table-info']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'start', 
                        'lable' => 'วันเวลาออกเดินทาง',
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'title',
                        'label' =>'จุดหมายปลายทาง',
                        'format'=>'raw', 
                        'value'=> $model->data_json['point'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id',
                        'label' =>'ผู้จอง',
                        'format'=>'raw', 
                        'value'=> $model->data_json['fullname'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id',
                        'label' =>'ผู้จอง',
                        'format'=>'raw', 
                        'value'=> $model->data_json['phone'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id',
                        'label' =>'จำนวนผู้โดยสาร',
                        'format'=>'raw', 
                        'value'=> $model->data_json['passenger_number'],
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'car_id',
                        'label' =>'จำนวนผู้โดยสาร',
                        'format'=>'raw', 
                        'value'=> $model->car->data_json['band'] .' เลขทะเบียน <code>'. $model->car->data_json['car_regis'].'</code>',
                    ],
                ],
            ],
            
        ],
    ]) ?>

    </div>
    <div class="col-4">

<div class="card border-0 mt-5" style="width:100%;">
    <?=Html::img(['/file', 'id' => $model->car_id, ['class' => 'card-img-top']])?>
    <div class="card-body">

        <table class="table table-light">
            <tbody>
                <tr>
                    <td>เลขทะเบียน</td>
                    <td><?php print_r($model->car->data_json['car_regis']);?></td>
                </tr>
                <tr>
                    <td>ยี่ห้อ</td>
                    <td><?php print_r($model->car->data_json['band']);?></td>
                </tr>
                <tr>
                    <td>รุ่น</td>
                    <td><?php print_r($model->car->data_json['model']);?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

</div>
</div>
