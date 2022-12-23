<?php

use app\modules\vehicle\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Json;
use yii\web\JsExpression;
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



<div class="row">
<div class="col-6">



<?=\edofre\fullcalendar\Fullcalendar::widget([
    'options' => [
        'id' => 'calendar',
        'language' => 'th',
    ],
    'clientOptions' => [
        'theme' => false,
        'weekNumbers' => true,
        'selectable' => true,
        'defaultView' => 'month',
        'eventClick' => new JsExpression("
        function(event, delta, revertFunc, jsEvent, ui, view) {
            $(this).css('border-color', 'red');
            BookingView(event.id);
        }
        "),
        'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log(event);
                }
            "),
        
    ],
    'events' => Url::to(['/vehicle/booking/events', 'id' => '']),
    
]);
?>
</div>
<div class="col-6">


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
        <?php foreach ($dataProviderRoom->getModels() as $model):?>
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

                <?= Html::a('<i class="fa-regular fa-pen-to-square"></i> จอง', ['/meeting/booking/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php Pjax::end(); ?>
</div>

</div>