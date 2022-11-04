<?php
use app\modules\bookingcar\AppAsset;
use yii\helpers\Url;
use yii\web\JsExpression;
AppAsset::register($this);
$AssetBundle = AppAsset::register($this);
?>


<br>
<div class="container">
    <div class="row">

        <div class="col-6">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php echo $this->render('car_items', [
            'searchModel' => $searchModelCar,
            'dataProvider' => $dataProviderCar,
        ]); ?>


        </div>
        <div class="col-6">
            <br>
            <div class="card">
                <div class="card-body">
                   
        
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
        'eventResize' => new JsExpression("
                function(event, delta, revertFunc, jsEvent, ui, view) {
                    console.log(event);
                }
            "),

    ],
    'events' => Url::to(['/bookingcar/default/events', 'id' => '1111']),
]);
?>
        </div>
            </div>
            <!-- end Card -->
        </div>
    </div>
</div>






<div class="row">
    <div class="col-12">
    </div>
</div>

<div class="row">
    <div class="col-6">
        <?php
//      $this->render('bookinglist', [
//       'searchModel' => $searchModel,
//       'dataProvider' => $dataProvider,
//   ]);
?>
    </div>
    <div class="col-6">

    </div>
</div>